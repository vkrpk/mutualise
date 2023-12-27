<?php
namespace App\Http\Controllers\Profil;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RemoveAccountController extends Controller {

    public function remove(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|current_password'
        ], [
            'required' => 'Champ requis',
            'current_password' => 'Le mot de passe ne correspond pas'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $users = User::findOrFail(Auth::id());

        $users->delete();

        return response()->json(['password' => true]);
    }
}
