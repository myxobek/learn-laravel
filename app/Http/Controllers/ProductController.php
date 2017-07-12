<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return DB::table('products as p')
            ->leftJoin('product_vouchers as pv', 'p.id', '=', 'pv.product_id')
            ->leftJoin('vouchers as v', function($join)
            {
                $join
                    ->on('v.id', '=', 'pv.voucher_id')
                    ->whereDate('date_from', '<=', date('Y-m-d H:i:s') )
                    ->whereDate('date_till', '>=', date('Y-m-d H:i:s') );
            })
            ->select(
                'p.id as id',
                'p.name as name',
                DB::raw('FLOOR( price * ( 1 - ( LEAST( COALESCE( SUM(v.discount), 0 ), 60) / 100 ) ) ) as price')
            )
            ->orderBy('p.id')
            ->groupBy('p.id')
            ->get();
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
