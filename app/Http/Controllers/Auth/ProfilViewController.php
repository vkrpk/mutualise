<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\LoginSecurity as login;

class ProfilViewController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $route = Route::currentRouteName();
        return view('auth.profil.index', compact('user', 'route'));
    }
    public function billing()
    {
        $route = Route::currentRouteName();
        return view('auth.profil.billing', compact('route'));
    }
    public function security()
    {
        $user = Auth::user();
        $route = Route::currentRouteName();
        $google2fa_url = "";
        $secret_key = "";

        if ($user->loginSecurity()->exists()) {
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                'MyNotePaper Demo',
                $user->email,
                $user->loginSecurity->google2fa_secret
            );
            $secret_key = $user->loginSecurity->google2fa_secret;
        }
        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url,
            'route' => $route
        );
        return view('auth.profil.security')->with('data', $data);
    }
    public function notifications()
    {
        $route = Route::currentRouteName();
        return view('auth.profil.notifications', compact('route'));
    }
}
