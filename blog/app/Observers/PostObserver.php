<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    
    public function creating(Post $post)
    {
        if (! \App::runningInConsole()) {
            /* con esto haremos que el usuario no pueda crear post desde otro id */
            $post->user_id = auth()->user()->id;
        }
    }

   
    public function deleting(Post $post)
    {
        /* con esto eliminaremos las imagenes almacenadas cada qeu eliminemos un post */
        if ($post->image) {
            Storage::delete($post->image->url);
        }
    }

    
}
