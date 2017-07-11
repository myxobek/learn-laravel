<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
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
