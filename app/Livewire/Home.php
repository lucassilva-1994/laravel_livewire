<?php

namespace App\Livewire;

use App\Models\HelperModel;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public $user_id;
    #[Rule('required|min:3|max:255')]
    public $content;

    public $title;

    public function create(){
        $this->validate();
        $this->user_id = auth()->user()->id;
        if(HelperModel::setData($this->all(), Post::class))
            $this->reset();
            return session()->flash('success','Poste criado com sucesso.');
        return session()->flash('error','Falha ao realizar post');
    }

    public function logout(){
        auth()->logout();
        return $this->redirect('/', navigate: true);
    }

    #[Layout('components.layouts.app')]
    #[Title('Home')]
    public function render()
    {
        $posts = Post::latest('id')->get();
        return view('livewire.home',compact('posts'));
    }
}
