<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $casts = [
        'vouchers_ids' => 'array'
    ];
}
