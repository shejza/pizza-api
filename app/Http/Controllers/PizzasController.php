<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class PizzasController extends Controller
{
    public function get(Request $request)
    {
        $offset = isset($request->offset) ? $request->offset : 0;
        $limit = isset($request->limit) ? $request->limit : 10;
        $search = $request->search;

        $pizzas = Pizza::when($search, function($query) use ($search) {
            $query->where('title', 'like', '%'. $search .'%');
        })
            ->orderBy('updated_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($pizzas, 200);
    }
}
