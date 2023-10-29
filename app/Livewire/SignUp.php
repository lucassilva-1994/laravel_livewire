<?php

namespace App\Livewire;

use App\Models\HelperModel;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class SignUp extends Component
{
    #[Rule('required|min:3|max:100')]
    public $name;
    #[Rule('required|min:3|max:100')]
    public $username;
    #[Rule('required|min:3|max:100|unique:users')]
    public $email;
    #[Rule('required|min:3|max:100')]
    public $password;

    public function create(){
        $this->validate();
        HelperModel::setData($this->all(),User::class);
        $this->reset();
        return session()->flash('success','Cadastrado com sucesso.');
    }

    #[Layout('components.layouts.app')]
    #[Title('Cadastre-se')]
    public function render()
    {
        return view('livewire.sign-up');
    }
}
