<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class PostShow extends Component
{
    public function delete(string $id){
        if(Post::whereId($id)->delete())
            $this->redirect('/', navigate: true);
            return session()->flash('success','Post removido');
        return session()->flash('error','Falha ao remover.');
    }

    #[Layout('components.layouts.app')]
    #[On('post-list')]
    public function render()
    {
        $posts = Post::latest('order')->get();
        return view('livewire.post.post-show', compact('posts'));
    }
}
