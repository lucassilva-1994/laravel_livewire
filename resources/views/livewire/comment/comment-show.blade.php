<div>
    <div class="row">
        @foreach ($comments as $comment)
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
        @if ($comments->hasMorePages())
            <button type="button" class="btn btn-primary" wire:click="loadMore">Carregar mais</button>
        @endif
    </div>
</div>
