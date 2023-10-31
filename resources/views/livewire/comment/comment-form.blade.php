<div class="m-2">
    <div class="row">
        <form wire:submit="create">
            <div class="input-group mt-3 mb-3">
                <input type="text" class="form-control" placeholder="Escreve um comentário." wire:model="comment" />
                <button class="btn btn-primary" type="submit">Comentar</button>
            </div>
        </form>
    </div>
</div>
