<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeTailModel extends Model
{
    use HasFactory;

    protected $table = 't_order_detail';
    
    protected $fillable = [
        'id',
        'm_id_order',
        'm_id_product',
        'm_price',
        'm_quanti',
        'm_product_name',
    ];
    public function showimgproduct(){
        return $this->hasOne(product::class, 'id', 'm_id_product');
    }
    public function showmasanpham(){
        return $this->hasOne(OrderModel::class, 'id','m_id_order');
    }
}
