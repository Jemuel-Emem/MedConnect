<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accounts extends Model
{
   protected $fillable = [
        'name',
        'department',
        'contact',
    ];
}
