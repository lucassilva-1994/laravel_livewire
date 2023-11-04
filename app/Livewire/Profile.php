<?php

namespace App\Livewire;

use App\Models\HelperModel;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Profile extends Component
{
    public $user_id;
    public $edit;

    public function mount(string $id){
        $this->user_id = $id;
    }

    #[Title('Perfil')]
    #[Layout('components.layouts.app')]
    public function render()
    {
        $user = User::whereId($this->user_id)->first();
        return view('livewire.profile', ['user'=>$user]);
    }
}
