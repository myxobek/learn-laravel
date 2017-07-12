<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVoucher extends Model
{
    protected $fillable = [
        'product_id', 'voucher_id'
    ];
}
