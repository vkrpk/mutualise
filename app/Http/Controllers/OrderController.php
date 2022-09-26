<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Addresses;
use Illuminate\Http\Request;
use App\Services\StripeService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\ItemCollection;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'formula' => [
                'required',
                Rule::in(['monthly', 'yearly', 'free']),
            ],
            'cartItemId' => [
                'required',
                'string'
            ]
        ]);

        $item = \Cart::get($request->cartItemId) ?? "";
        if (!$item) {
            return back();
        }

        $formula = $request->formula;
        $price = 0;
        switch ($formula) {
            case 'yearly':
                $price = ($item->price + 14);
                break;
            case 'monthly':
                $price = ($item->attributes->priceMonthly + 14);
                break;
            case 'free':
                $price = 0;
                break;
        }

        $user = Auth::user();
        $address = Addresses::where("user_id", $user->id)->first();

        return view("orders.create", compact('item', 'address', 'formula'))->with('price', (int)$price);
    }
}
