<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CalculAmountController;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart.list', compact('cartItems'));
    }

    public static function accessCart(){
        $cartItems = \Cart::getContent();
        return $cartItems;
    }

    public function addToCart(Request $request)
    {
        $price = (new CalculAmountController())->calculAmount($request->form_level, $request->form_diskspace);
        if($request->id) {
            \Cart::update($request->id, [
                'id' => $request->id,
                'name' => $request->accessName,
                'price' => $price['Y'],
                'quantity' => ['relative' => false, "value" => 1],
                'attributes' => array(
                    'form_level' => $request->form_level,
                    'domainType' => $request->domainType,
                    'domainUrlOrPrefix' => $request->domainType === "dedikam" ? "www." . $request->domainUrlOrPrefix . ".dedikam.com" : $request->domainUrlOrPrefix,
                    'form_diskspace' => $request->form_level == 'dédié' ? $request->sizeValueForDedicatedOffer : $request->form_diskspace,
                    'priceMonthly' => $price['M'],
                    'coupon' => false,
                    'buttonsRadioForOffer' => $request->buttonsRadioForOffer ?? '',
                )
            ]);
        } else {
            \Cart::add([
                'id' => Str::random(20),
                'name' => $request->accessName,
                'price' => $price['Y'],
                'quantity' => 1,
                'attributes' => array(
                    'form_level' => $request->form_level,
                    'domainType' => $request->domainType,
                    'domainUrlOrPrefix' => $request->domainType === "dedikam" ? "www." . $request->domainUrlOrPrefix . ".dedikam.com" : $request->domainUrlOrPrefix,
                    'form_diskspace' => $request->form_level == 'dédié' ? $request->sizeValueForDedicatedOffer : $request->form_diskspace,
                    'priceMonthly' => $price['M'],
                    'coupon' => false,
                    'buttonsRadioForOffer' => $request->buttonsRadioForOffer ?? '',
                )
            ]);
        }
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
