<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use App\Models\HelperModel;
use App\Models\Post;
use Livewire\Component;

class CommentForm extends Component
{
    public $user_id;
    public $post_id;
    public $comment;

    public function mount($post_id)
    {
        $post = Post::whereId($post_id)->first();
        $this->post_id = $post->id;
        $this->user_id = auth()->user()->id;
    }

    public function create()
    {
        HelperModel::setData([
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'comment' => $this->comment
        ], Comment::class);
        $this->reset(['comment']);
    }

    public function render()
    {
        return view(
            'livewire.comment.comment-form');
    }
}
