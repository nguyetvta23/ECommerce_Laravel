<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmt_Product extends Model
{
   protected $table = "t_commentproduct";
   protected $primaryKey = "idbl";
   protected $dates = [
      'created_at',
      'updated_at',
   ];
   protected $fillable = [
      'm_id_maloai ',
      'm_id_user ',
      'm_id_parent',
      'm_content',
      'answer_cmt',
      'm_status',
      'ratings',
      'ngaybinhluan',
  ];
   public function showiduser(){
      return $this->hasOne(User::class,'id','m_id_user');
   }
   public function showavatar(){
      return $this->hasMany(User::class,'id','m_id_user');
   }
   public function testorder(){
      return $this->hasOne(OrderModel::class,'m_id_user','m_id_user');
   }
}
