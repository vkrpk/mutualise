<?php
namespace App\Http\Controllers\Profil;

use App\Models\Addresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreInfosController extends Controller {

    public function store(Request $request) {
        $request->validate([
            'label' => ['required', 'string', 'max:60'],
            'address1' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:100'],
            'email' => ['string', 'max:255', 'nullable'],
            'first_name' => ['string', 'max:60', 'nullable'],
            'last_name' => ['string', 'max:60', 'nullable'],
            'organization' => ['string', 'max:100', 'nullable'],
            'address2' => ['string', 'max:100', 'nullable'],
            'state' => ['string', 'max:60', 'nullable'],
            'country' => ['string', 'max:60', 'nullable'],
            'phone_number' => ['string', 'max:60', 'nullable'],
        ]);

        $data = $request->all();
        $user = Auth::user();
        $bddAddress = Addresses::where('user_id', auth()->user()->id)->where('label', $data['label'])->first();
        if ($bddAddress) {
            $address = $bddAddress;
        } else {
            $address = new Addresses();
            $address->user_id = $user->getAuthIdentifier();
            $address->label = $data['label'];
        }
        /**
         * @var App/Models/Adresses
        */
        $address->first_name = $data['first_name'];
        $address->last_name = $data['last_name'];
        $address->organization = $data['organization'];
        $address->address1 = $data['address1'];
        $address->address2 = $data['address2'];
        $address->postal_code = $data['postal_code'];
        $address->city = $data['city'];
        $address->state = $data['state'];
        $address->country = $data['country'];
        $address->phone_number = $data['phone_number'];
        $user->email = $data['email'];
        $address->save();
        return back()->with("status", "Informations enregistrés !");
    }
}
