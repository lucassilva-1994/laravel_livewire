<div>
    <div class="row">
        <span class="col-md-12">
            <strong>{{ $comments->count() }} comentários.</strong>
        </span>
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
    </div>
</div>
