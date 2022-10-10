<?php

// require 'vendor/autoload.php';

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Formula;
use App\Models\Addresses;
use Illuminate\Support\Str;
use App\Models\MemberAccess;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
    public $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV')
        );
    }

    public function initWebhook()
    {
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

    public function stripe(Request $request)
    {
        $this->initWebhook();
        $request->merge(['price' => (int)$request->price]);
        $request->merge(['diskspace' => (int)$request->diskspace]);

        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'address.identifier' => ['required', 'string', 'max:60'],
            'address.address' => ['required', 'string', 'max:255'],
            'address.address_complement' => ['string', 'max:100', 'nullable'],
            'address.postal_code' => ['required', 'string', 'max:10'],
            'address.city' => ['required', 'string', 'max:100'],
            'address.state' => ['string', 'max:60', 'nullable'],
            'address.country' => ['string', 'max:60', 'nullable'],
            'address.phone_number' => ['string', 'max:60', 'nullable'],
            'checboxCGU' => ['accepted'],
            'comment' => ['string', 'max:1000', 'nullable'],
            'cartItemId' => ['required', 'string'],
            'formula_period' => ['required', Rule::in(['yearly', 'monthly', 'free'])]
        ]);

        if($validator->fails()){
            return redirect(route('order.create'), 307)->withErrors($validator)->withInput();
        }

        Addresses::updateOrCreate(
            ['user_id' => $user->id],
            [
                'identifier' => $request->address['identifier'],
                'address' => $request->address['address'],
                'address_complement' => $request->address['address_complement'],
                'postal_code' => $request->address['postal_code'],
                'city' => $request->address['city'],
                'state' => $request->address['state'],
                'country' => $request->address['country'],
                'phone_number' => $request->address['phone_number']
            ]
        );

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
                ],
                'success_url' => env('APP_URL') . '/order/store?id=' . $item->id,
                'cancel_url' => env('APP_URL'),
            ]);
        } elseif ($request->formula_period === 'free') {
            $response = Http::withOptions([ "verify"=> env('APP_ENV') === 'local' ? false : true ])->post(env("APP_URL") . "/success", [
                'address' => json_encode($request->address),
                'type' => "free",
                'user_id' => $user->id,
                'comment' => $request->comment,
                'member_access' => $item->attributes->buttonsRadioForOffer,
                'access_name' => $item->name,
                'diskspace' => $item->attributes->form_diskspace,
                'formula' => ucfirst($item->attributes->form_level),
            ]);

            return redirect()->route('order.store', ['id' => $item->id]);
        }
        return redirect($session->url);
    }

    public function success(Request $request)
    {
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
                $this->createAccesses($order);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } elseif ($request->type === "free") {
            DB::beginTransaction();
            try {
                $user = User::find($request->user_id);
                $user->nb_free_account = $user->nb_free_account + 1;
                $user->save();
                $address = json_decode($request->address);

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

                $formula = Formula::where('name', 'Standard')->first();

                $order = Order::create([
                    'user_id' => $user->id,
                    'payment_intent' => "Free",
                    'order_address_id' => $orderAddress->id,
                    'formula_id' => $formula->id,
                    'coupon_id' => isset($coupon) ? $coupon->id : null,
                    'mode' => "free",
                    'member_access' => "All",
                    'access_name' => $request->access_name,
                    'expire' => (new DateTime("+1 month"))->format("Y-m-d H:i:s"),
                    'comment' => $request->comment,
                    'status' => "succeeded",
                ]);
                $order = $order->fresh();
                $this->createAccesses($order);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }

    private function createAccesses(Order $order) {
        $passwordNotHash = Str::random();
        $dedikamAccessName = uniqid("dedikam"); // Pour éviter les conflits en mode dev
        $memberAccess = MemberAccess::createFromOrder($order, $passwordNotHash, $dedikamAccessName);
        $memberAccess = $memberAccess->fresh();
        switch ($order->member_access) {
            case 'All':
                $this->createAccessForNextcloud($memberAccess, $passwordNotHash);
                $this->createAccessForSeafile($memberAccess, $passwordNotHash);
                break;
            case 'Seafile':
                $this->createAccessForSeafile($memberAccess, $passwordNotHash);
                break;
            case 'Nextcloud':
                $this->createAccessForNextcloud($memberAccess, $passwordNotHash);
                break;
            default:
                return;
                break;
        }
    }

    private function createAccessForNextcloud(MemberAccess $memberAccess, string $passwordNotHash) {
        \App::call('App\Http\Controllers\MemberAccess\NextCloudController@create', ['memberAccess' => $memberAccess, 'passwordNotHash' => $passwordNotHash, 'dedikamAccessName' => $memberAccess->name]);
    }

    private function createAccessForSeafile(MemberAccess $memberAccess, string $passwordNotHash) {
        $listUsersSeafile = \App::call('App\Http\Controllers\MemberAccess\SeafileController@listUsers');
        global $update;
        foreach ($listUsersSeafile['data'] as $user) {
            if($user['email'] === $memberAccess->getUser()->email){
                $GLOBALS['update'] = true;
                \App::call('App\Http\Controllers\MemberAccess\SeafileController@updateUser', ['memberAccess' => $memberAccess]);
            }
        }
        if($GLOBALS['update'] !== true) {
            if(count($listUsersSeafile['data']) >= 2){
                \App::call('App\Http\Controllers\MemberAccess\SeafileController@deleteUser', ['email' => $listUsersSeafile['data'][2]['email']]);
            }
            \App::call('App\Http\Controllers\MemberAccess\SeafileController@create', ['memberAccess' => $memberAccess, 'passwordNotHash' => $passwordNotHash, 'dedikamAccessName' => $memberAccess->name]);
        }
    }
}
