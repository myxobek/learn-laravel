<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductVoucher;
use App\Voucher;
use Illuminate\Http\Request;

class ProductVoucherController extends Controller
{
    public function bind(Request $request, Voucher $voucher, Product $product)
    {
        $old_productVoucher = ProductVoucher::where('product_id', '=', $product->getKey())
            ->where('voucher_id', '=', $voucher->getKey())->first();
        if ( is_null($old_productVoucher))
        {
            $product_voucher = ProductVoucher::create([
                'product_id'    => $product->getKey(),
                'voucher_id'    => $voucher->getKey()
            ]);

            return response()->json($product_voucher, 200);
        }
        else
        {
            return response()->json(null, 406);
        }
    }

    public function unbind(Request $request, Voucher $voucher, Product $product)
    {
        $product_voucher = ProductVoucher::where('product_id', '=', $product->getKey())
            ->where('voucher_id', '=', $voucher->getKey())
            ->first();

        $product_voucher->delete();

        return response()->json(null, 204);
    }
}
