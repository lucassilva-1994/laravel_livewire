<div>
    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-10 col-lg-4 rounded">
            @include('message')
            <form class="row" wire:submit="auth">
                <div class="mb-3">
                    <label for="username">Usuário:</label>
                    <input type="text" class="form-control" id="username" wire:model="username" />
                </div>
                <div class="mb-3">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" wire:model="password" />
                </div>
                <div class="d-grid">
                    <button class="btn btn-success">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

