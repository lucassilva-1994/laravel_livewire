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

    public function delete(string $id){
        if(Post::whereId($id)->delete())
            $this->redirect('/', navigate: true);
            return session()->flash('success','Post removido');
        return session()->flash('error','Falha ao remover.');
    }

    public function logout(){
         auth()->logout();
         return $this->redirect('home', navigate:true);
    }

    #[Layout('components.layouts.app')]
    #[Title('Home')]
    public function render()
    {
        $posts = Post::latest('order')->get();
        return view('livewire.home',compact('posts'));
    }
}
