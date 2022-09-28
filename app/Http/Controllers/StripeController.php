<?php
// require 'vendor/autoload.php';

namespace App\Http\Controllers;

use DateTime;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Formula;
use App\Models\Addresses;
use Darryldecode\Cart\Cart;
use App\Models\OrderAddress;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SessionCookieJar;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session as SessionBrowser;

class StripeController extends Controller
{

    public $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV')
        );
    }

    public function stripe(Request $request)
    {
        $request->merge(['price' => (int)$request->price]);
        $request->merge(['diskspace' => (int)$request->diskspace]);

        $user = User::find(Auth::user()->id);

        $request->validate([
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
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => "Adhesion association",
                            ],
                            'unit_amount' => 1400,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'subscription',
                'success_url' => 'http://laravel-9.test',
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
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => "Adhesion association",
                            ],
                            'unit_amount' => 1400,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'metadata' => [
                    'comment' => $request->comment,
                    'formula_period' => $request->formula_period,
                    'address' => json_encode($request->address),
                    'cartItemId' => $item->id
                ],
                'success_url' => 'http://laravel-9.test/order/store',
                'cancel_url' => 'http://localhost:4242/cancel.html',
            ]);
        } elseif ($request->formula_period === 'free') {
            // session_start();
            // $jar = new SessionCookieJar("PHPSESSID", true);
            // $jar = new CookieJar();
            // $cookieJar = CookieJar::fromArray($request->cookies->all(), 'laravel-9.test');
            // $client = new Client();
            // $response = $client->request('POST', "http://laravel-9.test/success", [
            //     'json' => [
            //         'address' => $request->address,
            //         'type' => "free",
            //         'user_id' => $user->id,
            //         'comment' => $request->comment,
            //         'cartItemId' => $item->id,
            //         // 'session' => $jar
            //     ],
            //     'cookies' => $cookieJar
            // ]);
            //

            // login request
            $cookies = collect($request->cookies->all());
            // ->keyBy('Name')->map->Value;
            // dd($cookies->toArray());
            $response = Http::withCookies($cookies->toArray(), "http://laravel-9.test")->post('http://laravel-9.test/success', [
                'address' => json_encode($request->address),
                'type' => "free",
                'user_id' => $user->id,
                'comment' => $request->comment,
                'cartItemId' => $item->id,
            ]);

            // $response2 = Http::post("http://laravel-9.test/success", [
            //     'address' => json_encode($request->address),
            //     'type' => "free",
            //     'user_id' => $user->id,
            //     'comment' => $request->comment,
            //     'cartItemId' => $item->id,
            //     // 'session' => $jar
            // ])->c;     


            // return redirect()->action(
            //     'App\Http\Controllers\StripeController@success',
            //     [
            //         'address' => json_encode($request->address),
            //         'type' => "free",
            //         'user_id' => $user->id,
            //         'comment' => $request->comment,
            //         'cartItemId' => $item->id,
            //     ]
            // );
            // dd(SessionBrowser::all());
            return $response;
        }

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        if ($request->type === "charge.succeeded") {

            try {
                \Stripe\Stripe::setApiKey(env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV'));

                $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
                $customer = \Stripe\Customer::retrieve($session->customer);

                $user = User::where('email', $customer->email)->first();
                $user->stripe_id = $customer->id;
                $user->save();

                $item = \Cart::get($session->metadata->cartItemId);

                $address = json_decode($session->metadata->address);

                $orderAddress = OrderAddress::create(
                    [
                        'identifier' => $address->identifier,
                        'address' => $address->address,
                        'address_complement' => $address->address_complement,
                        'postal_code' => $address->postal_code,
                        'city' => $address->city,
                        'state' => $address->state,
                        'country' => $address->country,
                        'phone_number' => $address->phone_number,
                    ]
                );

                $formula = Formula::where('name', ucfirst($item->attributes->form_level))->first();
                $coupon = Coupon::where('code', $session->metadata->coupon)->first() ?? null;

                Order::create([
                    'user_id' => $user->id,
                    'order_address_id' => $orderAddress->id,
                    'formula_id' => $formula->id,
                    'coupon_id' => isset($coupon) ? $coupon->id : null,
                    'payment_intent' => $session->payment_intent,
                    'diskspace' => $item->attributes->form_diskspace,
                    'mode' => $session->mode, // !
                    'member_access' => $item->attributes->buttonsRadioForOffer !== null ? ucfirst(substr($item->attributes->buttonsRadioForOffer, 0, strpos($item->attributes->buttonsRadioForOffer, 'Offer'))) : "all",
                    'expire' => date('Y-m-d H:i:s', $session->expires_at), // !
                    'total_paid' => ($session->amount_total / 100),
                    'includes_adhesion' => !$user->is_adherent,
                    'comment' => $session->metadata->comment, // !
                    'status' => $session->status // !
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {

            // try {   
            dd(\Cart::getContent());

            $item = \Cart::get($request->cartItemId);

            dd($request->all());

            $address = json_decode($request->address);

            $orderAddress = OrderAddress::create(
                [
                    'identifier' => $address->identifier,
                    'address' => $address->address,
                    'address_complement' => $address->address_complement,
                    'postal_code' => $address->postal_code,
                    'city' => $address->city,
                    'state' => $address->state,
                    'country' => $address->country,
                    'phone_number' => $address->phone_number,
                ]
            );

            $formula = Formula::where('name', 'Standard')->first();
            $user = User::find($request->user_id);

            Order::create([
                'user_id' => $user->id,
                'order_address_id' => $orderAddress->id,
                'formula_id' => $formula->id,
                'coupon_id' => null,
                'payment_intent' => "Free",
                'diskspace' => $item->attributes->form_diskspace,
                'mode' => "Free", // !
                'member_access' => "all",
                'expire' => (new DateTime("+1 month"))->format("Y-m-d H:i:s"), // !
                'total_paid' => 0,
                'includes_adhesion' => !$user->is_adherent,
                'comment' => $request->comment, // !
                'status' => 'complete' // !
            ]);
            // } catch (\Exception $e) {
            //     return $e->getMessage();
            // }
        }
    }
}
