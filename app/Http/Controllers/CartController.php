<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use App\Services\CalculAmountController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart.list', compact('cartItems'));
    }

    public static function accessCart()
    {
        $cartItems = \Cart::getContent();
        return $cartItems;
    }

    public function addToCart(Request $request)
    {

        if (!isset($request->form_diskspace)) {
            $request->request->add(['form_diskspace' => 10]);
            $price = (new CalculAmountController())->calculAmount($request->form_level, $request->form_diskspace, true);
        } else {
            if($request->form_level === 'dédié'){
                $request->request->set('form_diskspace', $request->sizeValueForDedicatedOffer);
            }
            $price = (new CalculAmountController())->calculAmount($request->form_level, $request->form_diskspace);
        }
        if ($request->isFreeTrial == true) {
            Validator::make($request->all(), [
                'isFreeTrial' => 'accepted',
                'form_diskspace' => 'required|numeric|size:10',
            ])->validate();
        }

        $validatorGlobal = Validator::make($request->all(), [
            'form_level' => [
                'required',
                Rule::in(['basique', 'standard', 'entreprise', 'dédié']),
            ],
            'form_diskspace' => 'required|numeric|min:10|max:5000',
            'priceMonthly' => 'numeric',
            'accessName' => 'required',
        ]);

        $validatorGlobal
            ->sometimes('buttonsRadioForOffer',
                ['required', Rule::in(['seafileOfferBasique', 'nextcloudOfferBasique'])],
                function ($input) {
                    return $input->form_level === 'basique' ? true : false;
                })
            ->sometimes('sizeValueForDedicatedOffer',
                ['required', Rule::in([500, 1500, 3000, 5000])],
                function ($input) {
                    return $input->form_level === 'dédié' ? true : false;
                })
            ->sometimes('buttonsRadioForOffer',
                ['required', Rule::in(['seafileOfferDedicated', 'nextcloudOfferDedicated'])],
                function ($input) {
                    return $input->form_level === 'dédié' ? true : false;
                })
            ->sometimes('domainType',
                ['required', Rule::in(['dedikam', 'private'])],
                function ($input) {
                    return $input->form_level === 'dédié' ? true : false;
                })
            ->sometimes('domainUrlOrPrefix',
                ['required'],
                function ($input) {
                    return $input->form_level === 'dédié' ? true : false;
                })->validate()
            ;

        if($request->form_level === 'dédié'){
            if ($request->domainType === 'dedikam') {
                $validator = Validator::make(
                    [$request->domainUrlOrPrefix],
                    ['regex:/^((?![-.])[A-Z0-9-.]{1,63}(?<![-.]))+$/i'],
                    $messages = [
                        'regex' => 'Veuillez entrer un préfixe valide, points et tirets acceptés.',
                    ]
                )->validateWithBag("regex");
            } elseif ($request->domainType === 'private') {
                $validator = Validator::make(
                    [$request->domainUrlOrPrefix],
                    ['regex:/^((?!-)[A-Za-z0-9-]{1,63}(?<!-)\.)+[A-Za-z]{2,6}$/'],
                    $messages = [
                        'regex' => 'Veuillez entrer un nom de domaine valide, points et tirets acceptés.',
                    ]
                )->validateWithBag("regex");
            }
        }

        if (str_contains($request->domainUrlOrPrefix, ".dedikam.com")) {
            $request->domainUrlOrPrefix = str_replace(".dedikam.com", "", $request->domainUrlOrPrefix);
        }

        if ($request->id) {
            \Cart::update($request->id, [
                'id' => $request->id,
                'name' => $request->accessName,
                'price' => $request->isFreeTrial == "on" ? 0 : $price['Y'],
                'quantity' => ['relative' => false, "value" => 1],
                'attributes' => array(
                    'form_level' => $request->form_level,
                    'domainType' => $request->domainType,
                    'domainUrlOrPrefix' => $request->form_level == "dédié" ? ($request->domainType === "dedikam" ? $request->domainUrlOrPrefix . ".dedikam.com" : $request->domainUrlOrPrefix) : "",
                    'form_diskspace' => $request->form_level == 'dédié' ? $request->sizeValueForDedicatedOffer : $request->form_diskspace,
                    'priceMonthly' => $request->isFreeTrial == "on" ? 0 : $price['M'],
                    'coupon' => $request->isFreeTrial == "on" ? false : true,
                    'buttonsRadioForOffer' => $request->buttonsRadioForOffer ?? '',
                    'isFreeTrial' => $request->isFreeTrial,
                )
            ]);
        } else {
            \Cart::add([
                'id' => uniqid(),
                'name' => $request->accessName,
                'price' => $request->isFreeTrial == "on" ? 0 : $price['Y'],
                'quantity' => 1,
                'attributes' => array(
                    'form_level' => $request->form_level,
                    'domainType' => $request->domainType,
                    'domainUrlOrPrefix' => $request->form_level == "dédié" ? ($request->domainType === "dedikam" ? $request->domainUrlOrPrefix . ".dedikam.com" : $request->domainUrlOrPrefix) : "",
                    'form_diskspace' => $request->form_level == 'dédié' ? $request->sizeValueForDedicatedOffer : $request->form_diskspace,
                    'priceMonthly' => $request->isFreeTrial == "on" ? 0 : $price['M'],
                    'coupon' => $request->isFreeTrial == "on" ? false : true,
                    'buttonsRadioForOffer' => $request->buttonsRadioForOffer ?? '',
                    'isFreeTrial' => $request->isFreeTrial,
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
