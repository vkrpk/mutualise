<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
}
