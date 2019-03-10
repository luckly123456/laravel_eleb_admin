<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable = ['name','email','password','remember_token','status','shop_id'];

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
