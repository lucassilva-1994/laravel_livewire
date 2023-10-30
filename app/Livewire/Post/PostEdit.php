<?php

namespace App\Livewire\Post;

use App\Models\HelperModel;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class PostEdit extends Component
{
    public $id;
    public $title;
    #[Rule('required|min:3|max:255')]
    public $content;
    public $allowComments;

    public function mount($id){
        $post = Post::find($id);
        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->allowComments = $post->allowComments == 1 ? true : null;
    }

    public function update(){
        $post = Post::find($this->id);
        $this->allowComments == 1 ?  $this->allowComments = 1: $this->allowComments = 0;
        if(HelperModel::updateData($this->all(),Post::class,['id' => $post->id]))
             return session()->flash('success','Poste atualizado com sucesso.');
    }

    #[Layout('components.layouts.app')]
    #[Title('Editar')]
    public function render()
    {
        return view('livewire.post.post-edit');
    }
}
