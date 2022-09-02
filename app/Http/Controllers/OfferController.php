<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function services()
    {
        $cart = session()->get('cart');
        if ($cart) {
            $level = $cart['formula'];
            $free_account = $cart['free_account'];
            $diskspace = $cart['diskspace'];
            $access_name = $cart['access_name'];
        } else {
            $level = 'BAS';
            $free_account = 'false';
            $diskspace = 10;
            $access_name = '';
        }
        if(Auth::user()){
            $userId = auth()->user()->id;
            $user = User::where('id', $userId)->first();
            $nbfree = 4 - $user->nb_free_account;
        }
        if ($cart && array_key_exists('options', $cart)) {
            $option = in_array('nextcloud', $cart['options']) ? 'nextcloud' : 'pydio';
        } else {
            $option = 'nextcloud';
        }

        return view('orders.offer', [
            'user' => $user ?? '',
            'nbfreeaccount' => $nbfree ?? '',
            'level' => $level,
            'free_account' => $free_account,
            'diskspace' => $diskspace,
            'access_name' => $access_name,
            'option' => $option
        ]);
    }
}
