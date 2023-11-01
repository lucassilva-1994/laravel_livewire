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
    public $allowComments = true;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();
        $this->user_id = auth()->user()->id;
        $this->allowComments == 1 ?  $this->allowComments = 1: $this->allowComments = 0;
        $this->dispatch('post-list');
        if(HelperModel::setData($this->all(), Post::class))
            return session()->flash('success','Post criado com sucesso.');
            $this->reset();
        // $users = User::get();
        // foreach ($users as $user) {
        //     HelperModel::setData([
        //         'user_id' => $user->id,
        //         'allowComments' => 1,
        //         'title' => fake()->jobTitle(),
        //         'content' => fake()->realText()
        //     ], Post::class);
        // }
        // return session()->flash('success','Post criado com sucesso.');
        return session()->flash('error', 'Falha ao realizar post');
    }

    #[Layout('components.layouts.app')]
    #[Title('Home')]
    public function render()
    {
        return view('livewire.post.post-form');
    }
}
