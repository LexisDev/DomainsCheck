@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 style="margin-top:0">Dashboard</h2>
        <div class="row top-space">
            <a class="btn" href="{{ route('domains.index') }}">Мои домены</a>
        </div>
    </div>
@endsection

