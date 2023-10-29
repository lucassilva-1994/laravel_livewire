<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class SignIn extends Component
{
    #[Rule('required|exists:users')]
    public $username;
    public $password;

    public function auth(){
        $this->validate();
        $credentials = $this->only(['username','password']);
        if(Auth::attempt($credentials))
            session()->flash('success','Autenticado com sucesso.');
            return $this->redirect('/', navigate:true);
        return session()->flash('error','Falha na Autenticação.');
    }

    #[Layout('components.layouts.app')]
    #[Title('Entrar')]
    public function render()
    {
        return view('livewire.sign-in');
    }
}
