@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row" style="justify-content:space-between; align-items:center;">
            <h2 style="margin:0">Настройки домена</h2>
            <div class="row">
                <a class="btn" href="{{ route('domains.checks.index', $domain) }}">История</a>
                <a class="btn" href="{{ route('domains.index') }}">Назад</a>
            </div>
        </div>

        <div class="top-space muted">ID: {{ $domain->id }}</div>

        <form method="POST" action="{{ route('domains.update', $domain) }}" class="top-space">
            @csrf
            @method('PUT')
            @include('domains._form', ['domain' => $domain])
            <button class="btn" type="submit">Сохранить</button>
        </form>
    </div>
@endsection

