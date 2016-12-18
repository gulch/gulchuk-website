<?php

namespace Gulchuk\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'User';
    public $timestamps = false;
}