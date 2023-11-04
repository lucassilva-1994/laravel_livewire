<div wire:poll.1s>
    <div class="text-center mt-5">
        @if ($user)
            @if (auth()->check() && $user->id == auth()->user()->id)
                <h1><i class="bi bi-person-bounding-box"></i></h1>
                <h1>{{ $user->name }} ({{ $user->username }})</h1>
                <h3>Você tem: {{ $user->posts->count() }} posts</h3>
                <h4>Você está aqui desde: {{ $user->created_at }}</h4>
            @else
                <h1><i class="bi bi-person-bounding-box"></i></h1>
                <h1>{{ $user->name }} ({{ $user->username }})</h1>
                <h3>Quantidade de posts desse usuário: {{ $user->posts->count() }}</h3>
                <h4>Usando a plataforma desde desde: {{ $user->created_at }}</h4>
            @endif
        @else
            <h1>Usuário não encontrado</h1>
            <h2>Esse usuário não se encontra em nossa base de dados.</h2>
        @endif
    </div>
</div>
