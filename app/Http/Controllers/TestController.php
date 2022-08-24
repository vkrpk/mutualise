<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
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
        $user = "Bob";
        $nbfree = 4;
        $nbfree = $nbfree < 0 ? 0 : $nbfree;
        $enddate1y = Carbon::now();
        $enddate1y->addYears(1);
        $enddate30d = Carbon::now();
        $enddate30d->addDays(30);
        if ($cart && array_key_exists('options', $cart)) {
            $option = in_array('nextcloud', $cart['options']) ? 'nextcloud' : 'pydio';
        } else {
            $option = 'nextcloud';
        }

        return view('test', [
            'user' => $user,
            'nbfreeaccount' => $nbfree,
            'enddate1y' => $enddate1y,
            'enddate30d' => $enddate30d,
            'level' => $level,
            'free_account' => $free_account,
            'diskspace' => $diskspace,
            'access_name' => $access_name,
            'option' => $option
        ]);
    }
}
