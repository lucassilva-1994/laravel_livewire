<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\HelperModel;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class PostShow extends Component
{
    public $post_id;
    public $user_id;
    public $comment;
    public $perPage = 400;

    public function loadMore(){
        $this->perPage = $this->perPage + 20;
    }

    public function createComment(string $post_id){
        $this->post_id = $post_id;
        $this->user_id = auth()->user()->id;
        if(HelperModel::setData($this->all(), Comment::class))
            $this->reset();
    }

    public function delete(string $id){
        if(Post::whereId($id)->delete()){
            $this->redirect('/', navigate: true);
            return session()->flash('success','Post removido');
        }
        return session()->flash('error','Falha ao remover.');
    }


    public function like(string $post_id){
        $this->post_id = $post_id;
        $this->user_id = auth()->user()->id;
        $post = Post::find($post_id);
        $post->likes()->create($this->all());
    }

    #[Layout('components.layouts.app')]
    #[On('post-list')]
    public function render()
    {
        $posts = Post::latest('order')->get();
        return view('livewire.post.post-show', compact('posts'));
    }
}
