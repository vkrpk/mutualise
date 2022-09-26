<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function offers(string $id = null)
    {
        /**
         * @var Cart
         */
        $cartItem = \Cart::get($id);
        if ($cartItem) {
            $id = $id;
            $level = $cartItem->attributes->form_level;
            $formDiskspace = $cartItem->attributes->form_diskspace;
            $accessName = $cartItem->name;
            $domainType = $cartItem->attributes->domainType;
            $domainUrlOrPrefix = $cartItem->attributes->domainUrlOrPrefix;
            $option = $cartItem->attributes->buttonsRadioForOffer ?? '';
            $isFreeTrial = $cartItem->attributes->isFreeTrial ?? '';
        }
        if(Auth::user()){
            $userId = auth()->user()->id;
            $user = User::where('id', $userId)->first();
            $nbfree = 4 - $user->nb_free_account;
        }

        return view('offers.offer', [
            'nbfreeaccount' => $nbfree ?? '',
            'level' => $level ?? null,
            'formDiskspace' => $formDiskspace ?? null,
            'option' => $option ?? 'null',
            'accessName' => $accessName ?? '',
            'domainType' => $domainType ?? '',
            'domainUrlOrPrefix' => $domainUrlOrPrefix ?? '',
            'id' => $id ?? '',
            'isFreeTrial' => $isFreeTrial ?? '',
        ]);
    }
}
