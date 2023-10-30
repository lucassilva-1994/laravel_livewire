<div>
    @include('message')
    <a href="" wire:click.prevent="createUser">Criar usuário</a>
    <h1>{{ $title }}</h1>
    <input type="text" wire:model.live="search" class="form-control" placeholder="Type your search here..." />
    @if ($users->isNotEmpty())
        <table class="table mt-1">
            <thead>
                <tr>
                    <th wire:click="setSortBy('name')">Nome:</th>
                    <th wire:click="setSortBy('username')">Usuário:</th>
                    <th wire:click="setSortBy('email')">Email:</th>
                    <th>Ações:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                wire:click="delete('{{ $user->id }}')">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Por página:</td>
                    <td>
                        <select wire:model.live="perPage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                        </select>
                    </td>
                </tr>
            </tfoot>
        </table>
        <nav class="mt-3">
            <ul class="pagination justify-content-center">
                <li>
                    {{ $users->appends(request()->except('_token'))->links() }}
                </li>
            </ul>
        </nav>
    @else
        <div class="text-center">Nenhum usuário encontrado.</div>
    @endif
</div>
