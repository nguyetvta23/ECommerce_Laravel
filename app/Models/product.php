<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 't_product';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'id','m_id_category',
        'm_product_name',
        'm_product_slug',
        'm_short_description',
        'm_description',
        'm_picture','m_price',
        'm_original_price',
        'm_buy','m_view',
        'm_status',
        'created_at',
        'updated_at'];


    public function showdanhmuc(){
        return $this->hasOne(categoryModel::class,'id','m_id_category');
    }
    public function showcountcomment(){
        return $this->hasMany(Cmt_Product::class,'m_id_maloai','id');
    }

    // public function themsize(){
    //     return $this->belongsToMany(product_inventory::class,'t_product_inventory','m_id_product','m_size')->as('m_quanti');
    // }
    public function updatedsoluong(){
        return $this->hasOne(product_inventory::class, 'm_id_product', 'id');
    }
    public function updatedsoluong1(){
        return $this->hasMany(product_inventory::class, 'm_id_product', 'id');
    }
    public function themsoluong(){
        return $this->belongsToMany(product_inventory::class,'t_product_inventory','m_id_product','m_quanti');
    }
    public function scopeSearch($query)
    {
        if($key = request()->key){
            $query = $query->where('m_product_name','like','%'.$key.'%');
        }
        return $query;
    }
}
