<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;
    #[Rule('required| min:3')]
    public $name;
    #[Rule('required|email|unique:users')]
    public $email;
    protected $messages = [
        'name.required' => 'Nome é obrigatório.',
        'name.min' => 'O nome deve ter pelo menos :min caracteres.',
        'email.required' => 'Email é obrigatório.',
        'email.email' => 'Email inválido.',
        'email.unique' => 'Email já cadastrado.'
    ];
    public function create(){
        $this->validate();
        ModelsUser::create(['name' => $this->name,'email' => $this->email]);
        $this->reset();
        request()->session()->flash('success','Sucesso.');
    }

    public function render()
    {
        $title = "Usuários";
        $users = ModelsUser::latest()->paginate(5);
        return view('livewire.user', [
            'title' => $title,
            'users' => $users
        ]);
    }
}
