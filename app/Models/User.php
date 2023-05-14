<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'User';
    
    /**
     * The attributes that should be hidden for arrays.
    */
    protected $hidden = [
        'password', 
        'remember_token',
    ];
}
