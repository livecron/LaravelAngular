<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $fillable = [
        'nombre', 'precio', 'descripcion',
    ];

    public function categoria(){
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }

}
