<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //relacion polimorfica
    /**
     * cuando es una relacion polimorfica el nombre del metodo tiene que ser 
     * el mismo con el que especificamos anteriormente en la tabla
     * imageable
     */
    public function imageable()
    {
        return $this->morphTo();
    }

}
