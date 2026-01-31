@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 style="margin-top:0">Вход</h2>

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">Пароль</label>
                <input id="password" name="password" type="password" required>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field" style="flex-direction:row; align-items:center; gap:10px;">
                <input id="remember" name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="muted">Запомнить меня</label>
            </div>

            <button class="btn" type="submit">Войти</button>
        </form>

        <div class="muted top-space">
            Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a>
        </div>
    </div>
@endsection

