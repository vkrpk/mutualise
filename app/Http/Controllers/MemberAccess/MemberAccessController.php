<?php

namespace App\Http\Controllers\MemberAccess;

use App\Http\Controllers\Controller;
use App\Models\MemberAccess;
use Illuminate\Support\Facades\Auth;

class MemberAccessController extends Controller
{
    public function index() {
        $memberAccess = MemberAccess::find(6);
        $userId = Auth::user()->id;
        return view('access.index', [
            'userId' => $userId
        ]);
    }
}
