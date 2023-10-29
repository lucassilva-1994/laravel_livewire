<div>
    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-10 col-lg-4 rounded">
            @include('message')
            <form class="row" wire:submit="create">
                <div class="mb-2">
                    <label for="name">Nome:</label>
                    <input type="text" class="form-control" id="name" wire:model="name" autofocus />
                </div>
                <div class="mb-2">
                    <label for="username">Usuário:</label>
                    <input type="text" class="form-control" id="username" wire:model="username" />
                </div>
                <div class="mb-2">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" wire:model="email" />
                </div>
                <div class="mb-3">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" wire:model="password" />
                </div>
                <div class="d-grid">
                    <button class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
