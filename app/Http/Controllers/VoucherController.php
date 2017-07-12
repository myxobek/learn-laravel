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
}
