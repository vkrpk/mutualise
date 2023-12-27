<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function cguv() {
        return view('footer.cguv');
    }

    public function politiqueConfidentialite() {
        return view('footer.politique-confidentialite');
    }
}
