<?php
// require 'vendor/autoload.php';

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function stripe()
    {
        //     Stripe::setApiKey('sk_test_51LkoMCDcQMHfpUQVejZ0i8QRL7jmdAZRTzXipI1hOZ9HGMYAkWcyBOvvnem3byz9GWIkHVvEbUtkSOoFbCNF5ney00owRByo69');

        //     $session = Session::create([
        //         'line_items' => [[
        //             'price_data' => [
        //                 'currency' => 'usd',
        //                 'product_data' => [
        //                     'name' => 'T-shirt',
        //                 ],
        //                 'unit_amount' => 2000,
        //             ],
        //             'quantity' => 1,
        //         ]],
        //         'mode' => 'payment',
        //         'success_url' => 'https://example.com/success',
        //         'cancel_url' => 'https://example.com/cancel',
        //     ]);

        //     return $session;
        // }

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:4242/success.html',
            'cancel_url' => 'http://localhost:4242/cancel.html',
        ]);

        return $response->withHeader('Location', $session->url)->withStatus(303);
    }
}
