<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $fillable = [
        'carrierId', 'name', 'active'
    ];
}
