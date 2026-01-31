@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row" style="justify-content:space-between; align-items:center;">
            <div>
                <h2 style="margin:0">История проверок</h2>
                <div class="muted">{{ $domain->label ?: $domain->host }}</div>
            </div>
            <div class="row">
                <a class="btn" href="{{ route('domains.edit', $domain) }}">Настройки</a>
                <a class="btn" href="{{ route('domains.index') }}">К списку доменов</a>
            </div>
        </div>

        <div class="top-space" style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:14px;">
                <thead>
                <tr style="text-align:left; border-bottom:1px solid #24314f;">
                    <th style="padding:8px 6px;">Время</th>
                    <th style="padding:8px 6px;">Результат</th>
                    <th style="padding:8px 6px;">HTTP код</th>
                    <th style="padding:8px 6px;">Время ответа, мс</th>
                    <th style="padding:8px 6px;">Ошибка</th>
                </tr>
                </thead>
                <tbody>
                @forelse($checks as $check)
                    <tr style="border-bottom:1px solid #111827;">
                        <td style="padding:6px;">
                            {{ $check->checked_at->format('Y-m-d H:i:s') }}
                        </td>
                        <td style="padding:6px; color: {{ $check->is_success ? '#bbf7d0' : '#fecaca' }};">
                            {{ $check->is_success ? 'OK' : 'Ошибка' }}
                        </td>
                        <td style="padding:6px;">{{ $check->status_code ?? '—' }}</td>
                        <td style="padding:6px;">{{ $check->response_time_ms ?? '—' }}</td>
                        <td style="padding:6px; max-width:360px;">
                            <span class="muted">
                                {{ $check->error_message ? Str::limit($check->error_message, 120) : '—' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:8px;" class="muted">
                            Пока нет проверок. Дождитесь работы планировщика или выполните команду
                            <code>php artisan domains:check</code> в консоли.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="top-space">
            {{ $checks->links() }}
        </div>
    </div>
@endsection

