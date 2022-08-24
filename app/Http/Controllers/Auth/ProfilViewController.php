<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ProfilViewController extends Controller
{
    public function index()
    {
        return view('auth.profil');
    }
}
