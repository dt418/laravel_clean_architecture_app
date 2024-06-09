<?php

namespace App\Framework\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table = 'users';

    protected $fillable = ['name', 'email'];
}
