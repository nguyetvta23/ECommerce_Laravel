<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sliderModel extends Model
{
    use HasFactory;
    protected $table = 't_slider';
    protected $fillable = [
        'id',
        'm_images',
        'm_subtitle',
        'm_title',
        'm_description',
        'm_link',
        'm_status'
    ];
    public $timestamps = false;
    public function scopeSearch($query)
    {
        if($key = request()->key){
            $query = $query->where('m_product_name','like','%'.$key.'%');
        }
        return $query;
    }
}
