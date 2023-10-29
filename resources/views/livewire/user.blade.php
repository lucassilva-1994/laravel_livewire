<div>
    <form class="row" wire:submit="create">
        <div class="mb-3 col-md-4">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" placeholder="Seu nome" wire:model="name" autofocus />
        </div>
        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Seu email" wire:model="email" />
        </div>
        <div class="mb-3 col-md-4 d-grid"><br />
            <button class="btn btn-success btn-sm">Salvar</button>
        </div>
    </form>
    @include('message')
    <h1>{{ $title }}</h1>
    <input type="text" wire:model.live="search" class="form-control" placeholder="Type your search here..." />
    @if ($users->isNotEmpty())
        <table class="table mt-1">
            <thead>
                <tr>
                    <th>Nome:</th>
                    <th>Email:</th>
                    <th>Ações:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                wire:click="delete({{ '$user->id' }})">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="mt-3">
            <ul class="pagination justify-content-center">
                <li>
                    {{ $users->links() }}
                </li>
            </ul>
        </nav>
    @else
        <div class="text-center">Nenhum usuário encontrado.</div>
    @endif
</div>
