<?php
namespace App\Http\Controllers\Profil;

use App\Models\Addresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreInfosController extends Controller {

    public function store(Request $request) {

        $user = User::find(Auth::user()->id);

        $request->validate([
            'identifier' => ['required', 'string', 'max:60'],
            'address' => ['required', 'string', 'max:255'],
            'address_complement' => ['string', 'max:100', 'nullable'],
            'postal_code' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['string', 'max:60', 'nullable'],
            'country' => ['string', 'max:60', 'nullable'],
            'phone_number' => ['string', 'max:60', 'nullable'],
        ]);

        Addresses::updateOrCreate(
            ['id' => $user->address->id],
            [
                'identifier' => $request->identifier,
                'address' => $request->address,
                'address_complement' => $request->address_complement,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'phone_number' => $request->phone_number,            
            ]
        );
        
        return back()->with("status", "Informations enregistrés !");
    }
}
