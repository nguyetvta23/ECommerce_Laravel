<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    // public $timestamps = true;
    protected $filltable = [
        '_name', '_code'
    ];
    protected $primaryKey = 'id';
    protected $table = 'province';
    public function district()
    {
        return $this->hasMany(District::class,'_province_id', 'id');
    }
    public function ward()
    {
        return $this->hasMany(Ward::class,'_province_id', 'id');
    }
}
