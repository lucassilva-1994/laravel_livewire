<div wire:poll.1s>
    <div class="text-center mt-5">
        @if ($user)
            @auth
                <h1><i class="bi bi-person-bounding-box"></i></h1>
                @if ($user->id == auth()->user()->id)
                    @if ($edit == true)
                        Editando...
                    @endif
                    <button type="button" wire:model="edit">Editar</button>
                @endif
                <h1>{{ $user->name }} ({{ $user->username }})</h1>
                <h3>Quantidade de posts desse usuário: {{ $user->posts->count() }}</h3>
                <h4>Por aqui desde: {{ $user->created_at }}</h4>
            @endauth
        @else
            <h1>Usuário não encontrado</h1>
            <h2>Esse usuário não se encontra em nossa base de dados.</h2>
        @endif
    </div>
</div>
