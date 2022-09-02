<?php
namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\User;

class RemoveAccountController extends Controller{

    public function remove(int $id) {
        $users = User::findOrFail($id);

        $users->delete();
        return redirect()->route('home');
    }
}
