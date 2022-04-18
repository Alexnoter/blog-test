<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /* de esta manera activamos la asignacion masiva tambien existe el tipo  fillabel*/
    /* cuando activamos a travez por guarded tenemos que poner en el array los campos que queremos evitar que se  
    llenen por asignacion masiva */
    protected $guarded = ['id', 'created_at', 'update_at'];

    //relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relacion de muchos a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //relacion uno a uno polimorfica
    public function image()
    {
        return $this->morphOne(Image::class , 'imageable');
    }
}
