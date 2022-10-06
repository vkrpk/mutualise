<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MemberAccessController extends Controller
{
    public function create(Order $order){

    }

    public function listApi(){
        return response()->json(Order::all());
    }

    public function createApi(Request $request){
        $item = Order::create($request->all());
        return response()->json($item);
    }

    public function createApi2(Request $request){
        $name = $request->input('name');
        $date = $request->input('date');

        if($name){
          $concert = new Order();
          $concert->name = $name;
          $concert->date = $date;
          $concert->save();
          return response()->json(["status" => "success"]);
        }else{
          return response()->json(["status" => "error"]);
        }
      }

}
