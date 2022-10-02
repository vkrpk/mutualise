<?php

// require 'vendor/autoload.php';

namespace App\Http\Controllers;

use DateTime;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use GuzzleHttp\Client;
use App\Models\Formula;
use App\Models\Addresses;
use Darryldecode\Cart\Cart;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Cookie\SessionCookieJar;
use Illuminate\Support\Facades\Session as SessionBrowser;
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
                    'url' => 'http://laravel-9.test/success',
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
                    'diskspace' => $item->attributes->form_diskspace,
                    'formula' => ucfirst($item->attributes->form_level),
                ],
                'success_url' => 'http://laravel-9.test/order/store',
                'cancel_url' => 'http://localhost:4242/cancel.html',
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
                    'diskspace' => $item->attributes->form_diskspace,
                    'formula' => ucfirst($item->attributes->form_level),
                ],
                'success_url' => 'http://laravel-9.test/order/store',
                'cancel_url' => 'http://localhost:4242/cancel.html',
            ]);
        } elseif ($request->formula_period === 'free') {
            $response = Http::post("http://laravel-9.test/success", [
                'address' => json_encode($request->address),
                'type' => "free",
                'user_id' => $user->id,
                'comment' => $request->comment,
                'member_access' => $item->attributes->buttonsRadioForOffer,
                'diskspace' => $item->attributes->form_diskspace,
                'formula' => ucfirst($item->attributes->form_level),
            ]);

            return redirect()->route('order.store');
        }
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        if ($request->type === "charge.succeeded") {
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

                Order::create([
                    'user_id' => $user->id,
                    'payment_intent' => $paymentIntent,
                    'order_address_id' => $orderAddress->id,
                    'formula_id' => $formula->id,
                    'coupon_id' => isset($coupon) ? $coupon->id : null,
                    'diskspace' => (int)$session->metadata->diskspace,
                    'mode' => $session->mode,
                    'member_access' => $session->metadata->member_access !== "" ? ucfirst(substr($session->metadata->member_access, 0, strpos($session->metadata->member_access, 'Offer'))) : "All",
                    'expire' => date('Y-m-d H:i:s', time()),
                    'total_paid' => (float)($session->amount_total / 100),
                    'includes_adhesion' => !$user->is_adherent,
                    'comment' => $session->metadata->comment,
                    'status' => $request['data']['object']['status'],
                ]);
                $user->stripe_id = $customer->id;
                $user->is_adherent = true;
                $user->save();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } elseif ($request->type === "free") {
            try {
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
                $user = User::find($request->user_id);

                Order::create([
                    'user_id' => $user->id,
                    'payment_intent' => "Free",
                    'order_address_id' => $orderAddress->id,
                    'formula_id' => $formula->id,
                    'coupon_id' => isset($coupon) ? $coupon->id : null,
                    'mode' => "free",
                    'member_access' => "All",
                    'expire' => (new DateTime("+1 month"))->format("Y-m-d H:i:s"),
                    'comment' => $request->comment,
                    'status' => "complete",
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }
}
