<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    // public $timestamps = true;
    protected $filltable = [
        '_name', '_prefix', '_province_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'district';
    public function province()
    {
        return $this->belongsTo(Province::class, '_province_id', 'id');
    }
}
