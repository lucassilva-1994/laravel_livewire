<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;

class CommentShow extends Component
{
    public $post_id;
    public $posts;
    public function mount($post_id){
        $this->posts = Comment::wherePostId($post_id)->get();
    }

    public function render()
    {
        
        return view('livewire.comment.comment-show',['comments' => $this->posts]);
    }
}
