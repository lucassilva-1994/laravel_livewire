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
    public $user_id;
    #[Rule('required|min:3|max:100')]
    public $title;
    #[Rule('required|min:3|max:255')]
    public $content;
    public $allowComments;

    protected $messages = [
        'title.required' => 'O titulo é obrigatório.',
        'title.min' => 'O titulo deve ter no minimo :min caracteres.',
        'title.max' => 'O titulo deve ter no máximo :max caracteres.',
        'content.required' => 'O conteúdo é obrigatório.',
        'content.min' =>  'O conteúdo deve ter no minimo :min caracteres.',
        'content.max' => 'O conteúdo deve ter no máximo :max caracteres.'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount($id){
        $post = Post::find($id);
        $this->user_id = $post->user_id;
        if($this->user_id == auth()->user()->id){
            $this->id = $post->id;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->allowComments = $post->allowComments == 1 ? true : null;
            return;
        }
        session()->flash('error','Você não tem permissão para editar esse post.');
    }

    public function update(){
        $post = Post::find($this->id);
        $this->allowComments == 1 ?  $this->allowComments = 1: $this->allowComments = 0;
        if(HelperModel::updateData($this->all(),Post::class,['id' => $post->id]))
             session()->flash('success','Poste atualizado com sucesso.');
             return $this->redirect("/post/edit/{$this->id}", navigate:true);
    }

    #[Layout('components.layouts.app')]
    #[Title('Editar')]
    public function render()
    {
        return view('livewire.post.post-edit');
    }
}
