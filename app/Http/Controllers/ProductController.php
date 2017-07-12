<?php

namespace App\Http\Controllers;

use App\ProductVoucher;
use App\Voucher;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products as p')
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

        $products = $products->map(function($p)
        {
            $p->buy = '<a href="javascript:void(0);" class="btn btn-success buy-product" data-id="' . $p->id . '">Buy!</a>';
            return $p;
        });

        return $products;
    }

    public function create(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json($product);
    }

    public function buy(Request $request, Product $product)
    {
        // all product_vouchers by product_id
        $productVouchers = ProductVoucher::where('product_id', '=', $product->getKey());
        $productVouchers->get()->each(function($productVoucher)
        {
            // remove voucher
            $voucher = Voucher::where('id', '=', $productVoucher->getAttribute('voucher_id'))->first();
            $voucher->delete();
            // remove product_vouchers by voucher_id
            ProductVoucher::where('voucher_id', '=', $voucher->getKey())->delete();
        });
        // remove product
        $product->delete();

        return response()->json(null, 200);
    }
}
