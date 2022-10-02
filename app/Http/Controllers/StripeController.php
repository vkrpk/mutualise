<?php
// require 'vendor/autoload.php';

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Addresses;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
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
            'itemId' => ['required', 'string']
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
        $item = \Cart::get($request->itemId);
        $session = \Stripe\Checkout\Session::create([
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
            'success_url' => 'http://localhost:4242/success.html',
            'cancel_url' => 'http://localhost:4242/cancel.html',
        ]);

        dd($session);
        return redirect($session->url);
    }
}
