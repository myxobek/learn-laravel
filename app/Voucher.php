<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $casts = [
        'vouchers_ids' => 'array'
    ];

    protected $fillable = [
        'date_from', 'date_till', 'discount'
    ];
}
