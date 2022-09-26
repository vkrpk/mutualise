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

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        // dd($request->all());
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

        $stripe = new \Stripe\StripeClient(
            'sk_test_51LkoMCDcQMHfpUQVejZ0i8QRL7jmdAZRTzXipI1hOZ9HGMYAkWcyBOvvnem3byz9GWIkHVvEbUtkSOoFbCNF5ney00owRByo69'
        );

        if ($user->stripe_id === null) {

            $customer = $stripe->customers->create([
                'description' => 'Je suis un client test',
                'email' => $user->email,
            ]);
        } else {

            $customer = $stripe->customer->retrieve([
                $user->stripe_id, []
            ]);
        }

        // dd($customer->id);

        $item = \Cart::get($request->itemId);

        if ($request->formula === 'yearly') {

            $session = \Stripe\Checkout\Session::create([
                'customer' => $customer->id,
                'client_reference_id' => $user->id,
                // 'customer_details' => [
                //     "email" => "user@exmaple.org"
                // ],
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => $item->name,
                            ],
                            'unit_amount' => $request->price * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => 'http://laravel-9.test',
                'cancel_url' => 'http://localhost:4242/cancel.html',
            ]);
        } elseif ($request->formula === 'monthly') {

            $subscription = Stripe\SubscriptionSchedule::create([
                'customer' => "",
                'start_date' => 'now',
                'end_behaviour' => 'cancel',
                'phases' => [
                    [
                        'items' => [
                            'price' => ($request->price + 14) * 100,
                            'quantity' => 1,
                        ],
                    ],
                    'iterations' => 1,
                ],
                [
                    [
                        'items' => [
                            'price' => $request->price * 100,
                            'quantity' => 1,
                        ],
                    ],
                    'iterations' => 11,
                ],
            ]);
        } else {
            //
        }
        // dd($session);
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51LkoMCDcQMHfpUQVejZ0i8QRL7jmdAZRTzXipI1hOZ9HGMYAkWcyBOvvnem3byz9GWIkHVvEbUtkSOoFbCNF5ney00owRByo69'
        );

        // $customer = $stripe->customers->retrieve($request['data']['object']['customer']);

        $user = User::where('email', "admin@email.com")->first();
        $user->stripe_id = "Truc_au_pif";
        $user->save();

        return ('ok');
    }
}
