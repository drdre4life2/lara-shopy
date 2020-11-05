<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Clicknship extends Model
{
    protected $fillable = [
        'username', 'password', 'phone', 'store_city', 'locationId'
    ];
}
