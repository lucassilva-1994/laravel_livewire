<div>
    <form class="row" wire:submit="create">
        <div class="mb-3 col-md-4">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" placeholder="Seu nome" wire:model="name"
                name="name" />
        </div>
        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Seu email" wire:model="email"
                name="email" />
        </div>
        <div class="mb-3 col-md-4 d-grid"><br />
            <button class="btn btn-success btn-sm">Salvar</button>
        </div>
    </form>
    @include('message')
    <h1>{{ $title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
