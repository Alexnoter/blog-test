<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        /* el metodo pluck me trae todos los array pero solo tomara el valor que le esquecifiquemos en parentesis
        en este caso  sera los name y el segundo valor sera la llave del objeto*/
        $categories = Category::pluck('name', 'id');
        $tags =Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        /* return Storage::put('posts', $request->file('file'));  */
    
        $post = Post::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('public/storage/posts', $request->file('file'));

            $post->image()->create([
                'url' => $url
            ]);
        }
        
        /* aca preguntamos si mandamos informacion de etiqueta */
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show (Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit (Post $post)
    {
        /* es una regla de validacion de policy para ver que si sea el usuario correcto */
        $this->authorize('author', $post);


        /* el metodo pluck me trae todos los array pero solo tomara el valor que le esquecifiquemos en parentesis
        en este caso  sera los name y el segundo valor sera la llave del objeto*/
        $categories = Category::pluck('name', 'id');
        $tags =Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        /* es una regla de validacion de policy para ver que si sea el usuario correcto */
        $this->authorize('author', $post);


        $post->update($request->all());

        if ($request->file('file')) {
            $url = Storage::put('public/storage/posts', $request->file('file'));

            if ($post->image) {
                Storage::delete($post->image->url);

                $post->image->update([
                    'url'  => $url
                ]);
            }else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        /* el metodo sync sincroniza la coleccion que le digamos */
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy (Post $post)
    {
        /* es una regla de validacion de policy para ver que si sea el usuario correcto */
        $this->authorize('author', $post);

        
        $post->delete();
        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó correctamente');
    }
}
