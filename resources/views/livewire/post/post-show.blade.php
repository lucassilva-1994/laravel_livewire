<div wire:poll.10s>
    @if ($posts->isNotEmpty())
        <div class="mt-3">
            @foreach ($posts as $post)
                <div class="card mb-2">
                    <div class="card-header">
                        <h4>{{ str($post->title)->words(3) }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $post->content }}</h5>
                        @auth
                            <span class="list-inline">

                                @if ($post->likes->count())
                                    <h4><a href="" class="text-decoration-none text-danger list-inline-item"
                                            wire:click.prevent="unlike('{{ $post->id }}')"><i
                                                class="bi bi-suit-heart-fill"></i> ({{ $post->likesPosts->count() }})</a>
                                    </h4>
                                @else
                                    <h4><a href="" class="text-decoration-none  text-secondary list-inline-item"
                                            wire:click.prevent="like('{{ $post->id }}')"><i
                                                class="bi bi-suit-heart"></i> ({{ $post->likesPosts->count() }})</a></h4>
                                @endif
                                <h4><span class="text-decoration-none  text-primary list-inline-item"><i
                                            class="bi bi-chat-left-text"></i>
                                        ({{ $post->comments->count() }})
                                    </span></h4>
                            </span>
                            @foreach ($post->likesPosts as $users)
                                {{ $users->user->username }} &nbsp;
                            @endforeach
                            @if ($post->user->id == auth()->user()->id)
                                <button class="btn btn-danger btn-sm"
                                    wire:click="delete('{{ $post->id }}')">Excluir</button>
                                <a class="btn btn-success btn-sm" href="{{ route('post.edit', $post->id) }}"
                                    wire:navigate>Editar</a>
                            @endif
                            @if ($post->allowComments == true)
                                <livewire:comment.comment-form post_id="{{ $post->id }}"
                                    wire:key="{{ $post->id }}"></livewire:comment.comment-form>
                            @endif
                        @endauth
                        <div class="row">
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
            @if ($posts->hasMorePages())
                <button type="button" wire:click="loadMore" class="btn btn-primary">Carregar mais</button>
            @endif
        </div>
    @endif
</div>
