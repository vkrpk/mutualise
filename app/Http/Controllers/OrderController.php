<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Formula;
use Carbon\Traits\Date;
use App\Models\Addresses;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use App\Models\DedikamAccess;
use App\Services\StripeService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Darryldecode\Cart\ItemCollection;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'formula_period' => [
                'required',
                Rule::in(['monthly', 'yearly', 'free']),
            ],
            'cartItemId' => [
                'required',
                'string'
            ]
        ]);

        $formula_period = $request->formula_period;
        $cartItemId = $request->cartItemId;
        $item = \Cart::get($cartItemId) ?? "";
        if (!$item) {
            return back();
        }  

        return view("orders.create", compact('cartItemId', 'formula_period'));
    }

    public function store(Request $request)
    {
        // try {
        //     \Stripe\Stripe::setApiKey(env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV'));

        //     $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        //     $customer = \Stripe\Customer::retrieve($session->customer);

        //     $user = User::where('email', $customer->email)->first();
        //     $user->stripe_id = $customer->id;
        //     $user->save();

        //     $item = \Cart::get($session->metadata->cartItemId);

        //     $address = json_decode($session->metadata->address);

        //     $orderAddress = OrderAddress::create(
        //         [
        //             'identifier' => $address->identifier,
        //             'address' => $address->address,
        //             'address_complement' => $address->address_complement,
        //             'postal_code' => $address->postal_code,
        //             'city' => $address->city,
        //             'state' => $address->state,
        //             'country' => $address->country,
        //             'phone_number' => $address->phone_number,
        //         ]
        //     );

        //     $formula = Formula::where('name', ucfirst($item->attributes->form_level))->first();
        //     $coupon = Coupon::where('code', $session->metadata->coupon)->first() ?? null;

        //     Order::create([
        //         'user_id' => $user->id,
        //         'order_address_id' => $orderAddress->id,
        //         'formula_id' => $formula->id,
        //         'coupon_id' => isset($coupon) ? $coupon->id : null,
        //         'payment_intent' => $session->payment_intent,
        //         'diskspace' => $item->attributes->form_diskspace,
        //         'mode' => $session->mode, // !
        //         'member_access' => $item->attributes->buttonsRadioForOffer !== null ? ucfirst(substr($item->attributes->buttonsRadioForOffer, 0, strpos($item->attributes->buttonsRadioForOffer, 'Offer'))) : "all",
        //         'expire' => date('Y-m-d H:i:s', $session->expires_at), // !
        //         'total_paid' => ($session->amount_total / 100),
        //         'includes_adhesion' => !$user->is_adherent,
        //         'comment' => $session->metadata->comment, // !
        //         'status' => $session->status // !
        //     ]);

        //     \Cart::clear();

        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }

        // \Cart::clear();
        dd(\Cart::getContent());
        return redirect()->route('home');
    }
}
