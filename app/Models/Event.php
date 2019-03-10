<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['title','content','signup_start','prize_date','signup_end','signup_num','is_prize'];
}
