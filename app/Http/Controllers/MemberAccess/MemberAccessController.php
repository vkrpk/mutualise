<?php

namespace App\Http\Controllers\MemberAccess;

use App\Http\Controllers\Controller;

class MemberAccessController extends Controller
{
    public function index() {
        // $user = \App::call('App\Http\Controllers\MemberAccess\SeafileController@getUser', ['email' => 'victor.krupka@orange.fr']);
        // $users = \App::call('App\Http\Controllers\MemberAccess\SeafileController@listUsers');
        // dd($users['data'][0]['email']);
        // \App::call('App\Http\Controllers\MemberAccess\SeafileController@deleteUser', ['email' => 'victor.krupka@orange.fr']);
        return view('access.index');
    }
}
