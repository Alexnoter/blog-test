<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;

use Livewire\WithPagination;

class PostsIndex extends Component
{

    /* esto usamos para hacer la paginacion y el protected lo usamos para que use las clases de bootstrap */
    use WithPagination;
    protected $paginationTheme = "bootstrap";


    public function render()
    {
        $posts  = Post::where('user_id', auth()->user()->id)->latest('id')->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
