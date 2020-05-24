<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderDetailsController extends Controller
{
    public function get(Request $request)
    {
   
        $pizzas = DB::table('orderdetails')
            ->leftJoin('pizzas', 'orderdetails.pizza_id', '=', 'pizzas.id')
            ->get();
        

        return response()->json($pizzas, 200);
    }

       public function update(Request $request)  {
        if($request->quantity == 0) {
              $pizzas = OrderDetail::where('pizza_id',  $request->pizza_id)->delete();
        }
        else 
        {

        $pizzas = DB::table('orderdetails')
            ->leftJoin('pizzas', 'orderdetails.pizza_id', '=', 'pizzas.id')
            ->leftJoin('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->leftJoin('payments', 'orderdetails.payment_id', '=', 'payments.id')
            ->where('pizza_id',  $request->pizza_id)
             ->update(['pizza_id' => $request->pizza_id,
           'quantity' => $request->quantity,
           'price_order' => $request->price_order
        ]);
        }

           

        return response()->json($pizzas, 201);
    }

      public function delete(Request $request) {
             $pizzaId = $request->route('id');
       
       $pizza = OrderDetail::where('pizza_id',  $pizzaId)->delete();
        
        return response()->json($pizza, 205);
    }
}
