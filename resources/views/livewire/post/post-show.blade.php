<div   wire:poll.30s>
    @if ($posts->isNotEmpty())
        <div class="mt-3">
            @foreach ($posts as $post)
                <div class="card mb-2">
                    <div class="card-header">
                        <h4>{{ $post->title }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $post->content }}</h5>
                        @auth
                            @if ($post->user->id == auth()->user()->id)
                                <button class="btn btn-danger btn-sm"
                                    wire:click="delete('{{ $post->id }}')">Excluir</button>
                            @endif
                        @endauth
                    </div>
                    <div class="card-footer">
                        <span class="col-md-6 text-end"><strong>Postado</strong> em:
                            {{ $post->created_at }}</span>
                        <span class="col-md-6"><strong>Postado por</strong>: {{ $post->user->username }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
