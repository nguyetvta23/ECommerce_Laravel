<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_inventory extends Model
{
    use HasFactory;
    protected $table = "t_product_inventory";
    protected $fillable = ['m_id_product','m_quanti','m_size'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(product::class, 'm_id_product', 'id');
    }
}
