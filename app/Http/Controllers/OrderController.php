<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\MemberAccess;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client as GuzzleClient;

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
        \Cart::remove($request->input('id'));
        return view('orders.success');
    }

    public function index() {
        return view('orders.index');
    }

    public function getPDF($orderId, $userId) {
        $order = Order::find($orderId);
        if($order->user_id != $userId){
            abort(403);
        }
        $data = [
            'orderId' => $order->id
        ];
        $pdf = \PDF::loadView('components.order', $data);
        $pdfName = 'dedikam-facture-' . uniqid() . '-' . $orderId;
        return [
            'pdfName' => $pdfName,
            'pdf' => $pdf
        ];
    }

    public function downloadPDF(Request $request) {
        $pdf = $this->getPDF($request->orderId, $request->userId);
        return $pdf['pdf']->download($pdf['pdfName']);
    }

    public function getPathForPDF(Request $request) {
        $pdf = $this->getPDF($request->orderId, $request->userId);
        $pdf['pdf']->save(public_path('pdf') . '/' . $pdf['pdfName'] . '.pdf');
        return $pdf['pdfName'];
    }

    public function createAccessForNextcloud(Order $order, string $email, ?string $domain = '') {
        $dedikamAccessName = uniqid("dedikam"); // Pour éviter les conflits en mode dev
        $memberAccess = MemberAccess::createFromOrder($order, '', $dedikamAccessName, $email, true, $domain);
        $memberAccess = $memberAccess->fresh();
        \App::call('App\Http\Controllers\MemberAccess\NextCloudController@create', ['memberAccess' => $memberAccess, 'dedikamAccessName' => $memberAccess->name]);
        $this->sendEmailNotificationToAdmin($memberAccess);
    }

    public function createAccessForSeafile(Order $order, string $email, ?string $domain = '') {
        $dedikamAccessName = uniqid("dedikam"); // Pour éviter les conflits en mode dev
        $passwordNotHash = Str::random();
        $memberAccess = MemberAccess::createFromOrder($order, $passwordNotHash, $dedikamAccessName, $email, false, $domain);
        $memberAccess = $memberAccess->fresh();
        $listUsersSeafile = \App::call('App\Http\Controllers\MemberAccess\SeafileController@listUsers');
        global $update;
        foreach ($listUsersSeafile['data'] as $user) {
            if($user['email'] === $memberAccess->email){
                $GLOBALS['update'] = true;
                \App::call('App\Http\Controllers\MemberAccess\SeafileController@updateUser', ['memberAccess' => $memberAccess]);
            }
        }
        if($GLOBALS['update'] !== true) {
            // if(count($listUsersSeafile['data']) >= 3) {
            //     \App::call('App\Http\Controllers\MemberAccess\SeafileController@deleteUser', ['email' => $listUsersSeafile['data'][2]['email']]);
            // }
            \App::call('App\Http\Controllers\MemberAccess\SeafileController@create', ['memberAccess' => $memberAccess, 'passwordNotHash' => $passwordNotHash, 'dedikamAccessName' => $memberAccess->name]);
            $this->sendEmailNotificationToAdmin($memberAccess);
        }
    }

    public function sendEmailNotificationToAdmin(MemberAccess $memberAccess) {
        \Mail::send('mail.notificationToSupportWhenAccessIsCreate', $memberAccess->toArray(), function ($message) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to(env('MAIL_FROM_ADDRESS'), 'admin')->subject('Création de compte');
        });
    }

    public function sendEmailToUserAfterToOrder(Order $order) {
        $user = User::find($order->user_id);
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new GuzzleClient([
            'verify' => env('APP_ENV') === 'local' ? false : true,
            'headers' => $headers
        ]);
        $url = env('APP_URL') . '/orders/path-facture';
        $r = $client->request('POST', $url, [
            'form_params' => [
                'orderId' => $order->id,
                'userId' => $user->id
            ]
        ]);

        $response = $r->getBody()->getContents();

        \Mail::send('mail.order-create', $order->toArray(), function ($message) use ($response, $user) {
            $message->attach(asset('pdf/' . $response . '.pdf'));
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to($user->email, $user->name)->subject('Récapitulatif de votre commande');
        });
    }
}
