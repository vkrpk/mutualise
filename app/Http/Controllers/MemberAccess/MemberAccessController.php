<?php

namespace App\Http\Controllers\MemberAccess;

use App\Models\User;
use App\Models\Order;
use App\Models\MemberAccess;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberAccessController extends Controller
{
    public function index() {
        $userId = Auth::user()->id;
        $newOrder = Order::find(2);

        $user = User::find(4);
        // dd($user->id);
        // $pdf = \App::call('App\Http\Controllers\OrderController@getPDF', ['orderId' => 6, 'userId' => 4]);
        // dd($pdf['pdf']);
        // dd(env('APP_URL') . '/orders/path-facture');
        return view('access.index', [
            'userId' => $userId
        ]);
    }
}
