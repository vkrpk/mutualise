<?php

namespace App\Services;

use Stripe\Stripe;
use Darryldecode\Cart\ItemCollection;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

class StripeService
{

    protected $secretKey;

    public function __construct()
    {
        if (env("APP_ENV") == "local") {
            $this->secretKey = env('STRIPE_SECRET_KEY_DEV');
        } elseif (env('APP_ENV') == "production") {
            $this->secretKey = env('STRIPE_SECRET_KEY_PROD');
        }
    }

    public function getPaymentIntent(ItemCollection $cart)
    {

        $stripe = new \Stripe\StripeClient($this->secretKey);
        // dd($cart->price);
        $stripesession = $stripe->paymentIntents->create([
            "amount" => $cart->price * 100,
            "currency" => 'eur',
            "payment_method_types" => ['card']
        ]);
    }

    // $stripesession = Session::create([
    //     'line_items' => [[
    //         # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    //         'price' => 'pr_1234',
    //         'quantity' => 1,
    //     ]],
    //     'mode' => 'payment',
    //     'success_url' => '/success.html',
    //     'cancel_url' => '/cancel.html',
    // ]);
    // dd($stripesession);
}
