<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Formula;
use Carbon\Traits\Date;
use App\Models\Addresses;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use App\Models\DedikamAccess;
use App\Services\StripeService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Darryldecode\Cart\ItemCollection;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'formula_period' => [
                'required',
                Rule::in(['monthly', 'yearly', 'free']),
            ],
            'cartItemId' => [
                'required',
                'string'
            ]
        ]);

        $formula_period = $request->formula_period;
        $cartItemId = $request->cartItemId;
        $item = \Cart::get($cartItemId) ?? "";
        if (!$item) {
            return back();
        }  

        return view("orders.create", compact('cartItemId', 'formula_period'));
    }

    public function store(Request $request)
    {
        \Cart::clear();
        // dd(\Cart::getContent());
        return redirect()->route('home');
    }
}
