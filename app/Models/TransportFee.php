<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportFee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $filltable = [
        'm_province_id', 'm_district_id', 'm_ward_id', 'm_fee_ship',
    ];
    protected $primaryKey = 'id';
    protected $table = 't_transport_fee';
    public function province()
    {
        return $this->belongsTo(Province::class, 'm_province_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'm_district_id', 'id');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'm_ward_id', 'id');
    }
}
