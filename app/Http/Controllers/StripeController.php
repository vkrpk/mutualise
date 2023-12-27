<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Formula;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public $stripe;

    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(
            env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV')
        );
    }

    public function stripe(Request $request) {
        $this->initWebhook();
        $user = User::find(Auth::user()->id);
        \Stripe\Stripe::setApiKey(env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV'));
        if ($user->stripe_id === null) {
            $customer = $this->stripe->customers->create([
                'description' => $user->identifier,
                'email' => $user->email,
            ]);
        } else {
            $customer = $this->stripe->customers->retrieve($user->stripe_id);
        }
        $item = \Cart::get($request->cartItemId);
        $lineItemSubscription = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => "Adhesion association",
                ],
                'unit_amount' => 1400,
            ],
            'quantity' => 1,
        ];
        if ($request->formula_period === 'monthly') {
            $session = \Stripe\Checkout\Session::create([
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $this->stripe->prices->create([
                            'unit_amount' => $item->attributes->priceMonthly * 100,
                            'currency' => 'eur',
                            'recurring' => ['interval' => 'month'],
                            'product_data' => [
                                'name' => $item->name,
                            ],
                        ]),
                        'quantity' => 1
                    ],
                    $user->is_adherent ? [] : $lineItemSubscription
                ],
                'mode' => 'subscription',
                'metadata' => [
                    'comment' => $request->comment,
                    'formula_period' => $request->formula_period,
                    'address' => json_encode($request->address),
                    'member_access' => $item->attributes->buttonsRadioForOffer,
                    'access_name' => $item->name,
                    'diskspace' => $item->attributes->form_diskspace,
                    'formula' => ucfirst($item->attributes->form_level),
                    'emailSeafile' => $request->emailSeafile,
                    'emailNextcloud' => $request->emailNextcloud,
                    'domain' => $item->attributes->domainUrlOrPrefix
                ],
                'success_url' => env('APP_URL') . '/order/store?id=' . $item->id,
                'cancel_url' => env('APP_URL'),
            ]);
        } elseif ($request->formula_period === 'yearly') {
            $session = \Stripe\Checkout\Session::create([
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => $item->name,
                            ],
                            'unit_amount' => ($item->price) * 100,
                        ],
                        'quantity' => 1,
                    ],
                    $user->is_adherent ? [] : $lineItemSubscription
                ],
                'mode' => 'payment',
                'metadata' => [
                    'comment' => $request->comment,
                    'formula_period' => $request->formula_period,
                    'address' => json_encode($request->address),
                    'member_access' => $item->attributes->buttonsRadioForOffer,
                    'access_name' => $item->name,
                    'diskspace' => $item->attributes->form_diskspace,
                    'formula' => ucfirst($item->attributes->form_level),
                    'emailSeafile' => $request->emailSeafile,
                    'emailNextcloud' => $request->emailNextcloud,
                    'domain' => $item->attributes->domainUrlOrPrefix
                ],
                'success_url' => env('APP_URL') . '/order/store?id=' . $item->id,
                'cancel_url' => env('APP_URL'),
            ]);
        }
        return redirect($session->url);
    }

    public function success(Request $request) {
        if ($request->type === "charge.succeeded") {
            DB::beginTransaction();
            try {
                \Stripe\Stripe::setApiKey(env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV'));

                $paymentIntent = $request['data']['object']['payment_intent'];
                $session = $this->stripe->checkout->sessions->all(['payment_intent' => $paymentIntent])->first();
                $customer = \Stripe\Customer::retrieve($session->customer);
                $user = User::where('email', $customer->email)->first();

                $address = json_decode($session->metadata->address);
                $orderAddress = new OrderAddress();
                $orderAddress->identifier = $address->identifier;
                $orderAddress->address = $address->address;
                $orderAddress->address_complement = $address->address_complement;
                $orderAddress->postal_code = $address->postal_code;
                $orderAddress->city = $address->city;
                $orderAddress->state = $address->state;
                $orderAddress->country = $address->country;
                $orderAddress->phone_number = $address->phone_number;
                $orderAddress->save();

                $formula = Formula::where('name', $session->metadata->formula)->first();
                $coupon = Coupon::where('code', $session->metadata->coupon)->first() ?? null;
                $order = Order::create([
                    'user_id' => $user->id,
                    'payment_intent' => $paymentIntent,
                    'payment_mode' => 'stripe',
                    'order_address_id' => $orderAddress->id,
                    'formula_id' => $formula->id,
                    'coupon_id' => isset($coupon) ? $coupon->id : null,
                    'diskspace' => (int)$session->metadata->diskspace,
                    'mode' => $session->mode,
                    'member_access' => $session->metadata->member_access !== "" ? ucfirst(substr($session->metadata->member_access, 0, strpos($session->metadata->member_access, 'Offer'))) : "All",
                    'access_name' => $session->metadata->access_name,
                    'expire' => date('Y-m-d H:i:s', time()),
                    'total_paid' => (float)($session->amount_total / 100),
                    'includes_adhesion' => !$user->is_adherent,
                    'comment' => $session->metadata->comment,
                    'status' => $request['data']['object']['status'],
                ]);
                $order = $order->fresh();
                $user->stripe_id = $customer->id;
                $user->is_adherent = true;
                $user->save();
                $orderController = new OrderController;
                switch ($order->member_access) {
                    case 'All':
                        $orderController->createAccessForNextcloud($order, $session->metadata->emailNextcloud);
                        $orderController->createAccessForSeafile($order, $session->metadata->emailSeafile);
                        break;
                    case 'Seafile':
                        $orderController->createAccessForSeafile($order, $session->metadata->emailSeafile, $session->metadata->domain);
                        break;
                    case 'Nextcloud':
                        $orderController->createAccessForNextcloud($order, $session->metadata->emailNextcloud, $session->metadata->domain);
                        break;
                    default:
                        break;
                }
                DB::commit();
                if(isset($order) === true) {
                    $orderController->sendEmailToUserAfterToOrder($order);
                }
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }

    public function initWebhook() {
        try {
            if (count($this->stripe->webhookEndpoints->all()['data']) === 0) {
                $webhook = $this->stripe->webhookEndpoints->create([
                    'url' => env('APP_URL') . '/success',
                    'enabled_events' => [
                        'charge.succeeded',
                    ],
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
