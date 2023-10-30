<div wire:poll.1s>
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
                                <a class="btn btn-success btn-sm" href="{{ route('post.edit', $post->id) }}" wire:navigate>Editar</a>
                            @endif
                            @if ($post->allowComments == true)
                                <livewire:comment.comment-form post_id="{{ $post->id }}" wire:key="{{ $post->id }}"></livewire:comment.comment-form>
                            @endif
                        @endauth
                        <div class="row">
                            <span class="text-primary"><strong>{{ $post->comments->count() }}
                                    comentários.</strong></span>
                            @foreach ($post->comments as $comment)
                                <span class="col-md-2">
                                    <strong>{{ $comment->user->username }}</strong>:
                                </span>
                                <span class="col-md-8">
                                    {{ $comment->comment }}
                                </span>
                                <span class="col-md-2">
                                    {{ $comment->created_at }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <span class="col-md-4"><strong>Usuário: </strong>
                                {{ $post->user->username }}
                            </span>
                            <span class="col-md-4">
                                <strong>Criado em: </strong> {{ $post->created_at }}
                            </span>
                            <span class="col-md-4">
                                <strong>Atualizado em: </strong>: {{ $post->updated_at }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
