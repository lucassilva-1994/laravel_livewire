<div>
    @include('message')
    @if (isset(auth()->user()->username))
        <div class="row">
            <form wire:submit="update">
                <div class="mb-2">
                    <label for="title">Titulo:</label>
                    <input type="text" placeholder="Titulo do post" class="form-control" id="title" wire:model="title"
                        autofocus />
                </div>
                <div class="mb-2">
                    <textarea placeholder="Conteúdo" rows="5" class="form-control" wire:model="content"></textarea>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="allowComments" type="checkbox" wire:model="allowComments">
                    <label class="form-check-label" for="allowComments">
                        Permitir comentário?
                    </label>
                </div>
                <div class="col-md-3 d-grid">
                    <button class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endif
    @livewire('post.post-show')
</div>
