<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;
use App\OrderDetail;
use App\Order;
use App\Payment;

class PizzasController extends Controller
{
    public function get(Request $request)
    {
        $offset = isset($request->offset) ? $request->offset : 0;
        $limit = isset($request->limit) ? $request->limit : 10;
        $search = $request->search;

        $pizzas = Pizza::when($search, function($query) use ($search) {
            $query->where('name', 'like', '%'. $search .'%');
        })
            ->orderBy('updated_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($pizzas, 200);
    }

     public function update(Request $request)  {
          $order = new Order([
          'address' => 'default',
          'contact' => 'default',
          'user_id' => 1
        ]);
        $order->save();

         $card = new Payment([
            'card_number' => 'default',
            'card_name' =>'default',
            'cvv' => 0,
            'expiration_date' => 'default',
            'user_id' => 1
        ]);
        $card->save();
        // $pizza_id = $request->route('pizza_id');
        $orderdetails = new OrderDetail;
        $orderdetails->pizza_id = $request->pizza_id;
        $orderdetails->quantity = $request->quantity;
        $orderdetails->price = $request->price;
        $orderdetails->order_id =  $order->id;
        $orderdetails->payment_id = $card->id;
        $orderdetails->save();

        return response()->json($orderdetails, 201);
    }
}
