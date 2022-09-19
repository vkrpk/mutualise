<?php

namespace App\Http\Controllers\Profil;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreProfilPictureController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'avatar' => 'required|mimes:jpg,jpeg,png|max:5000'
        ]);

        if ($request->file('avatar')->isValid()) {
            $request->file('avatar')->move(base_path('resources/images/users/avatars'), $request->file('avatar')->getClientOriginalName());
            $path = 'resources/images/users/avatars' . "/" . $request->file('avatar')->getClientOriginalName();
            $user = User::find(Auth::id());
            $user->avatar = $path;
            $user->save();

            return back();
        }
    }
}
