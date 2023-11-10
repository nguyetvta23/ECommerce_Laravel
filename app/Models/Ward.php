<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    // public $timestamps = true;
    protected $filltable = [
        '_name', '_prefix', '_province_id', '_district_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'ward';
    public function province()
    {
        return $this->belongsTo(Province::class, '_province_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(Province::class, '_district_id', 'id');
    }
}
