<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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

    public function show(Post $post)
    {
        /* es una regla de validacion de policy para ver que si el post esta publicaco o en borrador 
        proteje los datos*/
        $this->authorize('published', $post);

        /* take me dice que solo me publicara 4 post */
        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            ->take(4)
                            ->get();

        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
                        ->where('status', 2)
                        ->latest('id')
                        ->paginate(6); 
        return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()->where('status', 2)
                            ->latest('id')
                            ->paginate(4);
        
        return view('posts.tag' , compact('posts', 'tag'));
    }
}
