<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /* este metodo es  para verificar  si  el usuario es el autor del post */

    /* siempre que se crea un metodo en una police el metodo siempre espera como  minimo un parametro */
    public function author(User $user, Post $post){
        if ($user->id == $post->user_id) {
            return true;
        }else {
            return false;
        }
    }

    public function published(?User $user, Post $post)
    {
        if ($post->status == 2) {
            return true;
        }else {
            return false;
        }
    }
}
