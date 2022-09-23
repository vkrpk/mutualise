<?php

namespace App\Http\Controllers;

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

        $price = 0;
        switch ($request->formula) {
            case 'yearly':
                $price = ($item->price + 14) * 100;
                break;
            case 'monthly':
                $price = ($item->attributes->priceMonthly + 14) * 100;
                break;
            case 'free':
                $price = 0;
                break;
        }
        return view("orders.create")->with(['item' => $item, 'price' => $price]);
    }

    public function create2(Request $request)
    {
        $user = Auth::user();
        $address = Addresses::where('user_id', $user->id)->first() ?? '';
        // dd($address);
        // $route = Route::currentRouteName();
        return view("orders.create", compact('user', 'address'));
    }
}
