<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Order;
use App\Models\Formula;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FreePaymentController extends Controller
{
    public function handlePayment(Request $request) {
        $user = User::find(Auth::user()->id);
        $item = \Cart::get($request->cartItemId);
        $response = Http::withOptions([
            "verify"=> env('APP_ENV') === 'local' ? false : true,
            "timeout" => 0,
        ])->post(env("APP_URL") . "/payment/free/success", [
            'address' => json_encode($request->address),
            'type' => "free",
            'user_id' => $user->id,
            'comment' => $request->comment,
            'member_access' => $item->attributes->buttonsRadioForOffer,
            'access_name' => $item->name,
            'diskspace' => $item->attributes->form_diskspace,
            'formula' => ucfirst($item->attributes->form_level),
            'emailSeafile' => $request->emailSeafile,
            'emailNextcloud' => $request->emailNextcloud,
        ]);
        return redirect()->route('order.store', ['id' => $item->id]);
    }

    public function success(Request $request) {
        DB::beginTransaction();
        try {
            $user = User::find($request->user_id);
            $user->nb_free_account = $user->nb_free_account + 1;
            $user->save();
            $address = json_decode($request->address);

            $orderAddress = new OrderAddress();
            $orderAddress->identifier = $address->identifier;
            $orderAddress->address = $address->address;
            $orderAddress->address_complement = $address->address_complement;
            $orderAddress->postal_code = $address->postal_code;
            $orderAddress->city = $address->city;
            $orderAddress->state = $address->state;
            $orderAddress->country = $address->country;
            $orderAddress->phone_number = $address->phone_number;
            $orderAddress->save();

            $formula = Formula::where('name', 'Standard')->first();

            $order = new Order();

            $order->user_id = $user->id;
            $order->payment_intent = "Free";
            $order->order_address_id = $orderAddress->id;
            $order->formula_id = $formula->id;
            $order->coupon_id = isset($coupon) ? $coupon->id : null;
            $order->mode = "free";
            $order->member_access = "All";
            $order->access_name = $request->access_name;
            $order->expire = (new DateTime("+1 month"))->format("Y-m-d H:i:s");
            $order->comment = $request->comment;
            $order->payment_mode = "free";
            $order->status = "succeeded";

            $order->save();
            $order = $order->fresh();
            $newOrder = Order::find($order->id);
            $orderController = new OrderController;
            $orderController->createAccessForNextcloud($newOrder, $request->emailNextcloud);
            $orderController->createAccessForSeafile($newOrder, $request->emailSeafile);
            DB::commit();
            if(isset($newOrder) === true) {
                $orderController->sendEmailToUserAfterToOrder($newOrder);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
