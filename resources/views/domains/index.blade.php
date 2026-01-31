@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row" style="justify-content:space-between; align-items:center;">
            <h2 style="margin:0">Домены</h2>
            <a class="btn" href="{{ route('domains.create') }}">Добавить</a>
        </div>

        <div class="top-space muted">Ваши домены для мониторинга.</div>

        <div class="top-space" style="display:flex; flex-direction:column; gap:10px;">
            @forelse ($domains as $domain)
                <div class="card" style="background:#0b1220;">
                    <div class="row" style="justify-content:space-between; align-items:center;">
                        <div>
                            <div style="font-weight:600">{{ $domain->label ?: $domain->host }}</div>
                            <div class="muted">
                                {{ $domain->host }} · {{ $domain->check_method }} · каждые {{ $domain->check_interval_minutes }} мин · timeout {{ $domain->timeout_seconds }}с
                                · {{ $domain->is_active ? 'активен' : 'выключен' }}
                            </div>
                        </div>
                        <div class="row">
                            <a class="btn" href="{{ route('domains.checks.index', $domain) }}">История</a>
                            <a class="btn" href="{{ route('domains.edit', $domain) }}">Настроить</a>
                            <form method="POST" action="{{ route('domains.destroy', $domain) }}" onsubmit="return confirm('Удалить домен?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="top-space muted">Пока нет доменов. Нажмите “Добавить”.</div>
            @endforelse
        </div>

        <div class="top-space">
            {{ $domains->links() }}
        </div>
    </div>
@endsection

