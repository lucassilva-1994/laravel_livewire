<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\HelperModel;
use App\Models\Like;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PostShow extends Component
{
    use WithPagination;
    public $search;
    public $post_id;
    public $user_id;
    public $comment;
    public $perPage = 10;
    public $orderBy = 'DESC';

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function mount(string $user_id = null)
    {
        $this->user_id = $user_id;
    }

    public function createComment(string $post_id)
    {
        $this->post_id = $post_id;
        $this->user_id = auth()->user()->id;
        if (HelperModel::setData($this->all(), Comment::class))
            $this->reset();
    }

    public function delete(string $id)
    {
        if (Post::whereId($id)->delete()) {
            $this->redirect('/', navigate: true);
            return session()->flash('success', 'Post removido');
        }
        return session()->flash('error', 'Falha ao remover.');
    }


    public function like(string $post_id)
    {
        $this->post_id = $post_id;
        $this->user_id = auth()->user()->id;
        $like = Like::wherePostId($this->post_id)->whereUserId($this->user_id)->first();
        if (!$like) {
            return Like::create([
                'user_id' => $this->user_id,
                'post_id' => $this->post_id,
                'created_at' => now()
            ]);
        }
    }

    public function unlike(string $post_id)
    {
        $this->post_id = $post_id;
        $this->user_id = auth()->user()->id;
        return Like::wherePostId($this->post_id)->whereUserId($this->user_id)->delete();
    }

    #[Layout('components.layouts.app')]
    #[On('post-list')]
    public function render()
    {
        $posts = Post::orderBy('order', $this->orderBy)
        ->where('title','like',"%{$this->search}%")
        ->orWhere('content','like',"%{$this->search}%")
        ->with('comments')->paginate($this->perPage);
        return view('livewire.post.post-show', compact(['posts']));
    }
}
