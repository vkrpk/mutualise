<?php

namespace App\Http\Controllers;

use App\Services\StripeService;
use Darryldecode\Cart\ItemCollection;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    static function intentSecret(ItemCollection $cart) {
        $stripeService = new StripeService;
        $intent = $stripeService->getPaymentIntent($cart);
        // dd($intent);
        return $intent["client_secret"] ?? null;
    }
}
