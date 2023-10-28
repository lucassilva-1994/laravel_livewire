<?php
namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;
    public $search;

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
        ModelsUser::create($this->all());
        $this->reset();
        session()->flash('success','Sucesso.');
        $this->redirect('/', navigate: true);
        $this->resetPage();
    }

    public function delete(int $id){
        if(ModelsUser::whereId($id)->delete())
            $this->redirect('/', navigate: true);
            return session()->flash('success','Sucesso');
        return session()->flash('error','Falha ao remover.');
    }

    #[Title('Usuários')]
    #[Layout('components.layouts.app')]
    public function render()
    {
        $title = "Usuários";
        $users = ModelsUser::latest()->
            where('name','like', "%{$this->search}%")
            ->orWhere('email','like', "%{$this->search}%")->paginate();
        return view('livewire.user', [
            'title' => $title,
            'users' => $users
        ]);
    }
}
