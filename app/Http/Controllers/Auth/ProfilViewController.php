<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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
        $route = Route::currentRouteName();
        return view('auth.profil.security', compact('route'));
    }
    public function notifications()
    {
        $route = Route::currentRouteName();
        return view('auth.profil.notifications', compact('route'));
    }
}
