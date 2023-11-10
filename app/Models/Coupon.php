<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $filltable = [
        'coupon_name', 'coupon_code', 'coupon_time', 'coupon_method', 'coupon_expired', 'coupon_value'
    ];
    protected $primaryKey = 'id';
    protected $table = 't_coupon';
}
