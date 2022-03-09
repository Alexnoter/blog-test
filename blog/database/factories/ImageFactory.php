<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //el primer parametro es la direccion donde almacenara  
            //segundo parametro el ancho de la img
            //tercer parametro el alto de la img
            //cuarto parametro era por  categorias pero solo ponemos  null
            //5to parametro true  o false ,  true me guarda toda la direccion
            'url' => 'posts/'. $this->faker->image('public/storage/posts' ,640 ,480 ,null, false),//nos guardara posts/img.jpg
        ];
    }
}
