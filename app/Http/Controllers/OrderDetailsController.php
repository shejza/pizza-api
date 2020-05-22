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
}
