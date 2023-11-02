<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentShow extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $post_id;

    public function loadMore(){
        $this->perPage += 10;
    }

    public function mount(string $post_id){
        $this->post_id = $post_id;
    }

    public function render()
    {
        $comments = Comment::wherePostId($this->post_id)->latest('order')->paginate($this->perPage);
        return view('livewire.comment.comment-show',['comments' => $comments]);
    }
}
