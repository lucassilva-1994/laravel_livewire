<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    #[Layout('components.layouts.app')]
    #[Title('Inicio')]
    public function render()
    {
        return view('livewire.home');
    }
}
