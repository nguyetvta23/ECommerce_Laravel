<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountModel extends Model
{
    use HasFactory;
    protected $table = 't_user';
    protected $fillable = ['id','name','email','phone','role','m_address','m_avatar','password','email_verified_at','m_status','remember_token'];

}
