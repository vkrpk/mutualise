<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        \Cart::remove($request->input('id'));
        return view('orders.success');
    }
}
