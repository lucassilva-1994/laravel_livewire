<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public function logout(){
         auth()->logout();
         return $this->redirect('home', navigate:true);
    }

    #[Layout('components.layouts.app')]
    #[Title('Home')]
    public function render()
    {
        return view('livewire.home');
    }
}
