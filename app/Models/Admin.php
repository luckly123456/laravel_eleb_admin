<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Model
{
    //
    use HasRoles;
    protected $guard_name = 'web';

    protected $fillable = ['name','email','password','remember_token'];




}
