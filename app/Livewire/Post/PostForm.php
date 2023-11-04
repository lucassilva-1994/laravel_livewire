<?php

namespace App\Livewire\Post;

use App\Models\HelperModel;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class PostForm extends Component
{
    public $user_id;
    #[Rule('required|min:3|max:100')]
    public $title;
    #[Rule('required|min:3|max:255')]
    public $content;
    #[Rule('required')]
    public $allowComments;
    public $post_id;

    public function mount(string $post_id = null){
        $post = Post::find($post_id);
        if($post){
            $this->user_id = $post->user_id;
            $this->post_id = $post->id;
            $this->content = $post->content;
            $this->title = $post->title;
            $this->allowComments = $post->allowComments;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();
        $this->user_id = auth()->user()->id;
        $this->dispatch('post-list');
        if(HelperModel::setData($this->all(), Post::class))
            $this->reset();
            return session()->flash('success','Post criado com sucesso.');
        return session()->flash('error', 'Falha ao realizar post');
    }

    public function update(){
        $this->validate();
        if(HelperModel::updateData([
            'title' => $this->title,
            'content' => $this->content,
            'allowComments' => $this->allowComments
        ],Post::class,['id' => $this->post_id]));
            return session()->flash('success','Post atualizado com sucesso.');
        return session()->flash('error','Falha ao atualizar post');
    }

    #[Layout('components.layouts.app')]
    #[Title('Home')]
    public function render()
    {
        return view('livewire.post.post-form',['post'=> $this->post_id]);
    }
}
