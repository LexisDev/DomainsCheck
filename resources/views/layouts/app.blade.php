<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; background: #0b1220; color: #e5e7eb; margin: 0; }
        a { color: inherit; }
        .container { max-width: 980px; margin: 0 auto; padding: 24px; }
        .card { background: #111a2e; border: 1px solid #24314f; border-radius: 12px; padding: 18px; }
        .nav { display:flex; align-items:center; justify-content:space-between; gap: 16px; margin-bottom: 18px; }
        .nav a { text-decoration:none; opacity: .9; }
        .nav a:hover { opacity: 1; }
        .btn { display:inline-block; padding: 10px 14px; border-radius: 10px; border: 1px solid #33466f; background: #172443; color: #e5e7eb; cursor:pointer; text-decoration:none; }
        .btn:hover { border-color: #4b6db0; }
        .btn-danger { border-color: #7f1d1d; background: #2a1114; }
        .row { display:flex; gap: 12px; flex-wrap: wrap; }
        .field { display:flex; flex-direction:column; gap: 6px; margin-bottom: 12px; }
        input { padding: 10px 12px; border-radius: 10px; border: 1px solid #33466f; background: #0b1220; color: #e5e7eb; }
        .muted { color: #9ca3af; }
        .error { color: #fecaca; }
        .success { color: #bbf7d0; }
        .top-space { margin-top: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <div class="row">
                <a class="btn" href="{{ url('/') }}">Главная</a>
                @auth
                    <a class="btn" href="{{ route('dashboard') }}">Dashboard</a>
                @endauth
            </div>

            <div class="row">
                @guest
                    <a class="btn" href="{{ route('login') }}">Вход</a>
                    <a class="btn" href="{{ route('register') }}">Регистрация</a>
                @else
                    <div class="muted">Вы: {{ auth()->user()->email }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger" type="submit">Выйти</button>
                    </form>
                @endguest
            </div>
        </div>

        @if (session('status'))
            <div class="card success top-space">{{ session('status') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>

