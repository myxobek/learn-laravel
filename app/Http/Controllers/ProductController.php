<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products as p')
            ->select(DB::raw('p.*, 
            ( 
                SELECT 
                    CONCAT(\'[\',group_concat(JSON_OBJECT(\'id\', v.id, \'discount\', v.discount, \'date_from\', v.date_from, \'date_till\', v.date_till)),\']\')
                FROM
                    vouchers as v
                WHERE
                    JSON_CONTAINS(p.vouchers_ids, CAST(v.id as char))
            ) as vouchers'))
            ->get();

        $products = $products->map(function($v)
        {
            $v->vouchers = json_decode( $v->vouchers, true );
            return $v;
        }, $products);

        return $products;
    }

    public function add(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json($product);
    }

    public function buy(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json($product, 200);
    }
}
