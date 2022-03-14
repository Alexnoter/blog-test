<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        /**
         * paginate me muestra solo 8 post
         * lates me muestra de manera descendentes y tenemos que especificar de acuerdo a que campo'id'
         */
        $posts = Post::where('status', 2)->latest('id')->paginate(8);

        return view('posts.index', compact('posts'));
    }
}
