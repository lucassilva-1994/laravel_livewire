<?php
namespace App\Livewire;

use App\Models\HelperModel;
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
    public $perPage = 10;

    public $sortBy = 'username';
    public $sortDir = 'desc';

    public function setSortBy($sortByField){
        if($this->sortBy === $sortByField){
            $this->sortDir = $this->sortDir == "ASC" ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'desc';
    }

    #[Rule('required| min:3')]
    public $name;
    #[Rule('required|email|unique:users')]
    public $email;

    public function create(){
        $this->validate();
        ModelsUser::create($this->all());
        $this->reset();
        session()->flash('success','Sucesso.');
        $this->redirect('/users', navigate: true);
        $this->resetPage();
    }

    public function createUser(){
        for($i=0;$i<10;$i++){
            HelperModel::setData([
                'name' => fake()->name,
                'username' => fake()->userName(),
                'email' => fake()->freeEmail(),
                'password' => '12345678910',
                'about_me' => fake()->realText()
            ], ModelsUser::class);
        }
        session()->flash('success','Cadastrado com sucesso.');
        //$this->redirect('/users', navigate: true);
    }

    public function delete(string $id){
        if(ModelsUser::whereId($id)->delete())
            return session()->flash('success','Excluido com sucesso.');
        return session()->flash('error','Falha ao excluir usuário.');
    }

    #[Title('Usuários')]
    #[Layout('components.layouts.app')]
    public function render()
    {
        $title = "Usuários";
        $users = ModelsUser::latest()->
            where('name','like', "%{$this->search}%")
            ->orWhere('email','like', "%{$this->search}%")
            ->orWhere('username','like', "%{$this->search}%")
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);
        $allUsers = ModelsUser::get();
        $this->resetPage();
        return view('livewire.user', [
            'title' => $title,
            'users' => $users,
            'allUsers' => $allUsers
        ]);
    }
}
