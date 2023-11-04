<div>
    @if (isset(auth()->user()->username))
        <div class="row">
            @include('message')
            <form wire:submit="{{ $post ? 'update' : 'create' }}">
                <div class="mb-2">
                    <label for="title">Titulo:</label>
                    <input type="text" placeholder="Titulo" class="form-control"
                        wire:model.live="title" autofocus />
                </div>
                <div class="mb-2">
                    <textarea placeholder="Conteúdo" rows="5" class="form-control" wire:model.live="content"></textarea>
                </div>
                <div class="mb-2">
                    <label for="allowComments">Permitir comentários?</label>
                    <select class="form-control" wire:model="allowComments">
                        <option value="">Selecione uma opção.</option>
                        <option value="YES">Sim</option>
                        <option value="NO">Não</option>
                    </select>
                </div>
                <div class="col-md-3 d-grid">
                    <button class="btn btn-primary">{{ $post ? 'Atualizar' : 'Postar' }}</button>
                </div>
            </form>
        </div>
    @endif
</div>
