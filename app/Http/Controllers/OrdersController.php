<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrdersController extends Controller
{
     public function create(Request $request) {
       
        $order = new Order;
        $order->address =  $request->address;
        $order->contact =  $request->contact;
         $order->user_id =  1;
        $order->save();

        return response()->json($order, 201);
    }
}
