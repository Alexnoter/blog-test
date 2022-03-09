<?php

namespace Database\Seeders;

use App\Models\Category;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //con este metodo me crea una carpeta en storage
        Storage::deleteDirectory('public/posts/');
        Storage::makeDirectory('public/posts/');

        // \App\Models\User::factory(10)->create();
        //llamamos el primero asi por que le asiganmos un 
        //usuario de manera manual
        $this->call(UserSeeder::class);
        //User::factory(100)->create();
        //esta es la manera
        Category::factory(4)->create();
        Tag::factory(8)->create();

        $this->call(PostSeeder::class);
        
    }
}
