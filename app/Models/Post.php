<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $filltable = [
        'm_id_user', 'm_title', 'm_desc', 'm_content', 'm_view', 'm_meta_desc', 'm_meta_keyword', 'm_status', 'm_image', 'm_slug'
    ];
    protected $primaryKey = 'id';
    protected $table = 't_post';
    public function user()
    {
        return $this->belongsTo(User::class, 'm_id_user', 'id');
    }
}
