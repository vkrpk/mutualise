<?php
namespace App\Http\Controllers\Profil;

use App\Models\User;
use App\Models\Addresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreInfosController extends Controller {

    public function store(Request $request) {

        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [  
            'address.identifier' => ['required', 'string', 'max:60'],
            'address.address' => ['required', 'string', 'max:255'],
            'address.address_complement' => ['string', 'max:100', 'nullable'],
            'address.postal_code' => ['required', 'string', 'max:10'],
            'address.city' => ['required', 'string', 'max:100'],
            'address.state' => ['string', 'max:60', 'nullable'],
            'address.country' => ['string', 'max:60', 'nullable'],
            'address.phone_number' => ['string', 'max:60', 'nullable'],
]);

        if($validator->fails()){
            return redirect(route('profilIndex'))->withErrors($validator)->withInput();
        }

        Addresses::updateOrCreate(
            ['user_id' => $user->id],
            [
                'identifier' => $request->address['identifier'],
                'address' => $request->address['address'],
                'address_complement' => $request->address['address_complement'],
                'postal_code' => $request->address['postal_code'],
                'city' => $request->address['city'],
                'state' => $request->address['state'],
                'country' => $request->address['country'],
                'phone_number' => $request->address['phone_number']
            ]
        );
        
        return back()->with("status", "Informations enregistrés !");
    }
}
