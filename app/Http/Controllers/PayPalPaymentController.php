<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Formula;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalPaymentController extends Controller
{
    public function handlePayment(Request $request) {
        $user = User::find(Auth::user()->id);
        $data = [];
        if ($user->is_adherent == false) {
            $data['items'][] = [
                'name' => 'Adhésion association',
                'price' => 14,
                'desc'  => 'Adhésion à l\'associtation Dedikam',
                'qty' => 1
            ];
        }
        $metadatas = [];
        $cartItem = \Cart::get($request->cartItemId);
        $paypalModule = new ExpressCheckout;
        if($request->formula_period === 'yearly') {
            $metadatas['mode'] = 'payment';
            $data['items'][] =
                [
                    'name' => $cartItem->name,
                    'price' => $cartItem->price,
                    'qty' => 1
                ]
            ;
            $data['invoice_id'] = random_int(1, 1000000);
            $data['invoice_description'] = "Order #{$data['invoice_id']} Bill";
            $data['return_url'] = route('success.payment');
            $data['cancel_url'] = route('cancel.payment');
            $total = 0;
            foreach ($data['items'] as $dataItem) {
                $total += $dataItem['price'];
            }
            $data['total'] = $total;
            $response = $paypalModule->setExpressCheckout($data);
        }
        if($request->formula_period === 'monthly') {
            $metadatas['mode'] = 'subscription';
            $data['items'][] = [
                'name' => $cartItem->name,
                'price' => $cartItem->attributes->priceMonthly,
                'qty' => 1
            ];
            $data['subscription_desc'] = "Monthly Subscription #1";
            $data['invoice_id'] = random_int(1, 1000000);
            $data['invoice_description'] = "Order #{$data['invoice_id']} Bill";
            $data['return_url'] = route('success.payment');
            $data['cancel_url'] = route('cancel.payment');
            $total = 0;
            foreach ($data['items'] as $dataItem) {
                $total += $dataItem['price'];
            }
            $data['total'] = $total;
            $response = $paypalModule->setExpressCheckout($data, true);
        }
        $metadatas['formula'] = ucfirst($cartItem->attributes->form_level);
        $metadatas['coupon'] = '';
        $metadatas['member_access'] = $cartItem->attributes->buttonsRadioForOffer;
        $metadatas['access_name'] = $cartItem->name;
        $metadatas['diskspace'] = $cartItem->attributes->form_diskspace;
        $metadatas['cartItemId'] = $request->cartItemId;

        session()->put($response['TOKEN'], array_merge($request->all(), $data, $metadatas));
        return redirect($response['paypal_link']);
    }

    public function paymentSuccess(Request $request) {
        $paypalModule = new ExpressCheckout;

        $expressCheckoutDetails = $paypalModule->getExpressCheckoutDetails($request->token);
        $data = [];
        $data['items'][] = [
            'name' => 'test',
            'price' => 47,
            'qty' => 1
        ];
        $data['total'] = 47;
        $data['invoice_description'] = "Paiement mensuel";
        $data['invoice_id'] = random_int(1, 1000000);

        // à conserver
        $input = $request->all();
        $response = $paypalModule->doExpressCheckoutPayment(session($input['token']), $input['token'], $input['PayerID']);
        // à conserver

        $paypalModule->doExpressCheckoutPayment($data, $expressCheckoutDetails['TOKEN'], $expressCheckoutDetails['PAYERID']);
        $startdate = Carbon::now()->toAtomString();
        $data  = [
            'PROFILESTARTDATE' => $startdate,
            'DESC' => random_int(1, 100000),
            'BILLINGPERIOD' => 'Month',
            'BILLINGFREQUENCY' => 1,
            'AMT' => 19.99,
            'CURRENCYCODE' => 'EUR',
        ];
        $paypalModule->createRecurringPaymentsProfile($data, $request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return $this->createOrder($input['token'], $input['PayerID']);
        }
        session()->remove($input['token']);
        return redirect()->route('home')->with('error', 'Erreur lors de la validation du paiement.');
    }

    public function createOrder(string $token, string $PayerID) {
        $request = session()->get($token);
        // dd($request);
        DB::beginTransaction();
        try {
            $user = User::find(Auth::user()->id);
            $address = $request['address'];
            $orderAddress = new OrderAddress();
            $orderAddress->identifier = $address['identifier'];
            $orderAddress->address = $address['address'];
            $orderAddress->address_complement = $address['address_complement'];
            $orderAddress->postal_code = $address['postal_code'];
            $orderAddress->city = $address['city'];
            $orderAddress->state = $address['state'];
            $orderAddress->country = $address['country'];
            $orderAddress->phone_number = $address['phone_number'];
            $orderAddress->save();
            $formula = Formula::where('name', $request['formula'])->first();
            $coupon = Coupon::where('code', $request['coupon'])->first() ?? null;
            $order = Order::create([
                'user_id' => $user->id,
                'payment_intent' => $request['invoice_id'],
                'payment_mode' => 'paypal',
                'order_address_id' => $orderAddress->id,
                'formula_id' => $formula->id,
                'coupon_id' => isset($coupon) ? $coupon->id : null,
                'diskspace' => (int)$request['diskspace'],
                'mode' => $request['mode'],
                'member_access' => $request['member_access'] !== "" ? ucfirst(substr($request['member_access'], 0, strpos($request['member_access'], 'Offer'))) : "All",
                'access_name' => $request['access_name'],
                'expire' => date('Y-m-d H:i:s', time()),
                'total_paid' => (float)($request['total']),
                'includes_adhesion' => !$user->is_adherent,
                'comment' => $request['comment'],
                'status' => 'succeeded',
            ]);
            $order = $order->fresh();
            $user->paypal_id = $PayerID;
            $user->is_adherent = true;
            $user->save();
            $orderController = new OrderController;
            switch ($order->member_access) {
                case 'All':
                    $orderController->createAccessForNextcloud($order, $request['emailNextcloud']);
                    $orderController->createAccessForSeafile($order, $request['emailSeafile']);
                    break;
                case 'Seafile':
                    $orderController->createAccessForSeafile($order, $request['emailSeafile'], isset($request['domain']) != false ? $request['domain'] : '');
                    break;
                case 'Nextcloud':
                    $orderController->createAccessForNextcloud($order, $request['emailNextcloud'], isset($request['domain']) != false ? $request['domain'] : '');
                    break;
                default:
                    break;
            }
            DB::commit();
            if(isset($order) === true) {
                $orderController->sendEmailToUserAfterToOrder($order);
            }
            session()->remove($token);
            return redirect(env('APP_URL') . '/order/store?id=' . $request['cartItemId']);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function paymentCancel(Request $request) {
        $input = $request->all();
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->doExpressCheckoutPayment(session($input['token']), $input['token'], $input['PayerID']);
        session()->remove($input['token']);
        return redirect()->route('home')->with('error', 'Erreur lors de la validation du paiement.');
    }
}
