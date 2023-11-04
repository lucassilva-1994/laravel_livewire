<div wire:poll.1s>
    <div class="mt-3">
        <div class="row">
            <div class="col-md-9">
                <input type="search" class="form-control"
                placeholder="Digite sua busca aqui..."
                 wire:model.live="search"/>
            </div>
            <div class="col-md-3">
                <select class="form-control" wire:model.live="orderBy">
                    <option value="ASC">Mais antigo</option>
                    <option value="DESC">Mais recente</option>
                </select>
            </div>
        </div>
    </div>
    @if ($posts->isNotEmpty())
        <div class="mt-3">
            @foreach ($posts as $post)
                <div class="card mb-2">
                    <div class="card-header">
                        <h4><strong>{{ $post->order }}</strong> - {{ str($post->title)->words(3) }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $post->content }}</h5>
                        @auth
                            <div class="d-flex flex-row">
                                @if ($post->likes->count())
                                    <h4><a class="text-decoration-none text-primary"
                                            wire:click.prevent="unlike('{{ $post->id }}')"><i
                                                class="bi bi-suit-heart-fill"></i>
                                            ({{ $post->likesPosts->count() }})
                                        </a>&nbsp;
                                    </h4>
                                @else
                                    <h4><a class="text-decoration-none  text-info"
                                            wire:click.prevent="like('{{ $post->id }}')"><i
                                                class="bi bi-suit-heart"></i>
                                            ({{ $post->likesPosts->count() }})</a>
                                    </h4>&nbsp;
                                @endif
                                <h4><span class="text-decoration-none"><i class="bi bi-chat-left-text"></i>
                                        ({{ $post->comments->count() }})
                                    </span></h4>&nbsp;&nbsp;
                                @if ($post->user->id == auth()->user()->id)
                                    <h4><a href="#" class="text-decoration-none  text-danger"
                                            wire:confirm="Tem certeza que deseja excluir esse '{{ $post->title }}'?"
                                            wire:click="delete('{{ $post->id }}')"><i class="bi bi-trash3-fill"></i></a>
                                    </h4> &nbsp;&nbsp;
                                    <h4><a class="text-decoration-none  text-success"
                                            href="{{ route('post.edit', $post->id) }}" wire:navigate><i
                                                class="bi bi-pencil-fill"></i></a></h4>
                                @endif
                            </div>
                            @foreach ($post->likesPosts->load('user') as $users)
                                <a href="{{ route('user.profile', $users->user->id) }}"
                                    class="text-decoration-none text-secondary" wire:navigate>
                                    <strong>{{ $users->user->username }} &nbsp;</strong>
                                </a>
                            @endforeach
                            @if ($post->allowComments == 'YES')
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
                        <div class="row">
                            @if (!auth()->check())
                                <a href="{{ route('user.signin') }}" class="text-decoration-none text-success"
                                    wire:navigate>Entre para se interagir com esse post.</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <span class="col-md-4"><strong>Usuário: </strong>
                                <a href="{{ route('user.profile', $post->user->id) }}"
                                    wire:navigate>{{ $post->user->username }}</a>
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
