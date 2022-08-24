<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ProfilViewController extends Controller
{
    public function index()
    {
        return view('auth.profil.index');
    }
    public function billing()
    {
        return view('auth.profil.billing');
    }
    public function security()
    {
        return view('auth.profil.security');
    }
    public function notifications()
    {
        return view('auth.profil.notifications');
    }
}
