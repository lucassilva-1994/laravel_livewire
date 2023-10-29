<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>{{ $title ?? 'Blog' }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg mb-3" style="background-color: #3a092a;">
        <div class="container">
            <a href="{{ route('home') }}" class="text-white" wire:navigate>Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <h2 class="text-light"><i class="bi bi-list"></i></h2>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="menu">
                <ul class="navbar-nav">
                    @if (!auth()->user())
                        <li class="nav-item">
                            <a class="nav-link link-light" href="{{ route('user.signin') }}" wire:navigate>Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-light" href="{{ route('user.signup') }}"
                                wire:navigate>Cadastre-se</a>
                        </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link link-light">{{ auth()->user()->username }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light" href="{{ route('logout') }}">Sair</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
