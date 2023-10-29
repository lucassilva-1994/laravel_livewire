<div wire:poll.20s>
    <div class="row justify-content-md-center mb-3">
        <div class="col-sm-12 col-md-10 col-lg-10 rounded">
            @if (isset(auth()->user()->username))
                <div>
                    <form wire:submit="create">
                        <div class="mb-2">
                            <label for="title">Titulo:</label>
                            <input type="text" placeholder="Titulo do post" class="form-control" id="title"
                                wire:model="title" autofocus />
                        </div>
                        <div class="mb-2">
                            <textarea placeholder="Conteúdo" class="form-control" wire:model="content"></textarea>
                        </div>
                        @include('message')
                        <div class="col-md-6 d-grid">
                            <button class="btn btn-primary">Postar</button>
                        </div>
                    </form>
                </div>
            @endif

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
    </div>
</div>
