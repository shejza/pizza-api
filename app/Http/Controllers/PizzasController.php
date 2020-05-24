<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pizza;
use App\OrderDetail;
use App\Order;
use App\Payment;

class PizzasController extends Controller
{
   public function get(Request $request)
    {
      
            
        $pizzas = DB::table('pizzas')
            ->leftjoin('orderdetails', 'pizzas.id', '=', 'orderdetails.pizza_id')
            ->select('pizzas.*',  'orderdetails.pizza_id') 
            ->limit(8)
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
      
        $pizza_id = OrderDetail::where('pizza_id',  $request->pizza_id)->get();

        $pizzas = Pizza::where('id',  $request->pizza_id)->get();
       error_log(  $pizza_id);
        if($pizza_id->isEmpty()) {

        $orderdetails = new OrderDetail;

        $orderdetails->pizza_id = $request->id;
        $orderdetails->quantity = 1;
        $orderdetails->price_order =  $request->price;
        $orderdetails->order_id =  $order->id;
        $orderdetails->payment_id = $card->id;
        $orderdetails->save();
        } else {
       $orderdetails = OrderDetail::where('pizza_id', $request->pizza_id)
          ->update(['pizza_id' => $request->pizza_id,
           'quantity' => $request->quantity,
           'price_order' => $request->price_order,
           'order_id' => $order->id,
           'payment_id' => $card->id,
           ]);
        }
      

        return response()->json($orderdetails, 201);
    }
}
