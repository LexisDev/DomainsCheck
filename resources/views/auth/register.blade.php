@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 style="margin-top:0">Регистрация</h2>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="field">
                <label for="name">Имя</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">Пароль</label>
                <input id="password" name="password" type="password" required>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Повтор пароля</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required>
            </div>

            <button class="btn" type="submit">Создать аккаунт</button>
        </form>

        <div class="muted top-space">
            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
        </div>
    </div>
@endsection

