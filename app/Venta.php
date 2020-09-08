<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $fillable = [
        'codigo', 'monto', 'user_id',
    ];
}
