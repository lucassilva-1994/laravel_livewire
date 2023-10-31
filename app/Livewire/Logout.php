<?php

namespace App\Livewire;

use Livewire\Component;

class Logout extends Component
{
    public function mount(){
        auth()->logout();
        return $this->redirect('/', navigate:true);
    }
}
