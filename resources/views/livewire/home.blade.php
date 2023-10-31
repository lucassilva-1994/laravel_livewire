<div class="row justify-content-md-center mb-3">
    <span class="row mt-2 text-secondary" wire:loading>
        <strong>Carregando...</strong>
    </span>
    @livewire('post.post-form')
    @livewire('post.post-show', ['lazy' => true])
</div>
