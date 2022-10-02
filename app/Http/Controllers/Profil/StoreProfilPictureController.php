<?php

namespace App\Http\Controllers\Profil;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;

class StoreProfilPictureController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'avatar' => 'required|mimes:jpg,jpeg,png|min:0|max:5000'
        ]);
        if ($request->file('avatar')->isValid()) {
            $newImageName = uniqid() . '-' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('avatars_uploads'), $newImageName);
            $user = User::find(Auth::id());
            $user->avatar = $newImageName;
            $user->save();
            return back();
        }
    }
}
