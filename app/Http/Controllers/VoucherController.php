<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;

class VoucherController extends Controller
{
    public function create(Request $request)
    {
        $voucher = Voucher::create($request->all());

        return response()->json($voucher);
    }

    public function bind(Request $request, Voucher $voucher)
    {
        $voucher->update($request->all());

        return response()->json($voucher, 200);
    }

    public function unbind(Request $request, Voucher $voucher)
    {
        $voucher->update($request->all());

        return response()->json($voucher, 200);
    }
}
