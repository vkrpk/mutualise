<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CalculAmountController;

class CartController extends Controller
{
    public function cartList()
    {
<<<<<<< HEAD
        $cartItems = \Cart::getContent();
        // dd($cartItems);
=======
        $cartItems = Cart::getContent();
>>>>>>> 8729cda509673a53b0b0dbf60dcaf8d55ed120bf
        return view('cart.list', compact('cartItems'));
    }

    public static function accessCart(){
        $cartItems = \Cart::getContent();
        return $cartItems;
    }

    public function addToCart(Request $request)
    {
        $price = (new CalculAmountController())->calculAmount($request->form_level, $request->form_diskspace);
<<<<<<< HEAD
        if($request->id) {
            \Cart::update($request->id, [
                'id' => $request->id,
                'name' => $request->accessName,
                'price' => $price['Y'],
                'quantity' => ['relative' => false, "value" => 1],
                'attributes' => array(
                    'form_level' => $request->form_level,
                    'form_diskspace' => $request->form_diskspace,
                    'priceMonthly' => $price['M'],
                    'coupon' => false,
                    'buttonsRadioForOffer' => $request->buttonsRadioForOffer ?? '',
                )
            ]);
        } else {
            \Cart::add([
                'id' => random_int(3, 5),
                'name' => $request->accessName,
                'price' => $price['Y'],
                'quantity' => 1,
                'attributes' => array(
                    'form_level' => $request->form_level,
                    'form_diskspace' => $request->form_diskspace,
                    'priceMonthly' => $price['M'],
                    'coupon' => false,
                    'buttonsRadioForOffer' => $request->buttonsRadioForOffer ?? '',
                )
            ]);
        }
=======
        /**
         * @var App\Models\User
         */
        $user = User::where('id', Auth::id())->first();
        \Cart::add([
            'id' => Carbon::now()->timestamp,
            'name' => "kek",
            'price' => $price['Y'],
            'quantity' => 1,
            'attributes' => array(
                'form_level' => $request->form_level,
                'form_diskspace' => $request->form_diskspace,
                'priceMonthly' => $price['M'],
                'coupon' => false,
                'buttonsRadioForOffer' => $request->buttonsRadioForOffer ?? '',
            )
        ]);
>>>>>>> 8729cda509673a53b0b0dbf60dcaf8d55ed120bf
        session()->flash('success', 'La commande a bien été ajoutée à votre panier !');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
