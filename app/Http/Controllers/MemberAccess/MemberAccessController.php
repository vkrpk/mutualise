<?php

namespace App\Http\Controllers\MemberAccess;

use App\Http\Controllers\Controller;
use App\Models\MemberAccess;

class MemberAccessController extends Controller
{
    public function index() {
        return view('access.index');
    }
}
