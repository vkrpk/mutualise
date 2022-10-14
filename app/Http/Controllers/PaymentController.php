<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as RequestFacade;

class PaymentController extends Controller
{
    public function handlePayment(Request $request) {
        $request->merge(['price' => (int)$request->price]);
        $request->merge(['diskspace' => (int)$request->diskspace]);

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
            'checboxCGU' => ['accepted'],
            'comment' => ['string', 'max:1000', 'nullable'],
            'cartItemId' => ['required', 'string'],
            'formula_period' => ['required', Rule::in(['yearly', 'monthly', 'free'])],
            'emailSeafile' => [
                '',
                'max:255',
                function ($attribute, $value, $fail) {
                    $seafileUser = \App::call('App\Http\Controllers\MemberAccess\SeafileController@getUser', ['email' => RequestFacade::input('emailSeafile')]);
                    if (isset($seafileUser['email']) && $value === $seafileUser["email"]) {
                        $fail('Cet email est déjà attribué');
                    }
                },
            ],
            'emailNextcloud' => [
                '',
                'max:255',
                function ($attribute, $value, $fail) {
                    $nextcloudUser = \App::call('App\Http\Controllers\MemberAccess\NextCloudController@getUser', ['email' => RequestFacade::input('emailNextcloud')]);
                    if ($nextcloudUser !== false && $value === $nextcloudUser["email"]) {
                        $fail('Cet email est déjà attribué');
                    }
                },
            ],
        ])->sometimes('emailSeafile', ['required', 'email'], function($input) {
                return \Cart::get($input->cartItemId)->attributes->buttonsRadioForOffer === 'seafileOfferBasique' ||
                \Cart::get($input->cartItemId)->attributes->buttonsRadioForOffer === 'seafileOfferDedicated' ||
                \Cart::get($input->cartItemId)->attributes->isFreeTrial === true;
            })
        ->sometimes('emailNextcloud', ['required', 'email'], function($input) {
                return \Cart::get($input->cartItemId)->attributes->buttonsRadioForOffer === 'nextcloudOfferBasique' ||
                \Cart::get($input->cartItemId)->attributes->buttonsRadioForOffer === 'nextcloudOfferDedicated' ||
                \Cart::get($input->cartItemId)->attributes->isFreeTrial === true;
            }
        )->sometimes('methodPayment', ['required', Rule::in(['paypal', 'stripe'])], function($input) {
                return \Cart::get($input->cartItemId)->attributes->isFreeTrial != true;
            }
        );

        if($validator->fails()){
            return redirect(route('order.create'), 307)->withErrors($validator)->withInput();
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
        if($request->methodPayment === 'stripe') {
            return (new StripeController)->stripe($request);
        } elseif ($request->methodPayment === 'paypal') {
            return (new PayPalPaymentController)->handlePayment($request);
        } elseif ($request->formula_period === 'free') {
            return (new FreePaymentController)->handlePayment($request);
        }
    }
}
