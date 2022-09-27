<?php
// require 'vendor/autoload.php';

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Addresses;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

        $user = User::find(Auth::user()->id);

        $request->validate([
            'identifier' => ['required', 'string', 'max:60'],
            'address' => ['required', 'string', 'max:255'],
            'address_complement' => ['string', 'max:100', 'nullable'],
            'postal_code' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['string', 'max:60', 'nullable'],
            'country' => ['string', 'max:60', 'nullable'],
            'phone_number' => ['string', 'max:60', 'nullable'],
            'checboxCGU' => ['accepted'],
            'comment' => ['string', 'max:1000', 'nullable'],
            'price' => ['required', 'integer'],
            'itemId' => ['required', 'string'],
            'formula' => ['required', Rule::in(['monthly', 'yearly', 'free'])],
        ]);

        Addresses::updateOrCreate(
            ['user_id' => $user->id],
            [
                'identifier' => $request->identifier,
                'address' => $request->address,
                'address_complement' => $request->address_complement,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'phone_number' => $request->phone_number,
            ]
        );

        \Stripe\Stripe::setApiKey(env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV'));

        if ($user->stripe_id === null) {

            $customer = $this->stripe->customers->create([
                'description' => 'Je suis un client test',
                'email' => $user->email,
            ]);

        } else {

            $customer = $this->stripe->customers->retrieve($user->stripe_id);
        }

        $item = \Cart::get($request->itemId);

        if ($request->formula === 'monthly') {

            $session = \Stripe\Checkout\Session::create([
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $this->stripe->prices->create([
                            'unit_amount' => $request->price * 100,
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

        } elseif ($request->formula === 'yearly') {

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
                            'unit_amount' => ($request->price) * 100,
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
                'success_url' => 'http://laravel-9.test/order/store?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost:4242/cancel.html',
            ]);

        } elseif ($request->formula === 'free') {

            // Créer session gratuite + update BDD

        }

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $customer = $this->stripe->customers->retrieve($request['data']['object']['customer']);
        
        $user = User::where('email', $customer->email)->first();
        $user->stripe_id = $customer->id;
        $user->save();
    }
}
