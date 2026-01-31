@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row" style="justify-content:space-between; align-items:center;">
            <h2 style="margin:0">Добавить домен</h2>
            <a class="btn" href="{{ route('domains.index') }}">Назад</a>
        </div>

        <form method="POST" action="{{ route('domains.store') }}" class="top-space">
            @csrf
            @include('domains._form')
            <button class="btn" type="submit">Сохранить</button>
        </form>
    </div>
@endsection

