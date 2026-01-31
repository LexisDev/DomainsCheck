@php
    /** @var \App\Models\Domain|null $domain */
    $domain = $domain ?? null;
@endphp

<div class="field">
    <label for="host">Домен (host)</label>
    <input id="host" name="host" type="text" value="{{ old('host', optional($domain)->host) }}" placeholder="example.com" required>
    @error('host') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="label">Название (label)</label>
    <input id="label" name="label" type="text" value="{{ old('label', optional($domain)->label) }}" placeholder="Мой сайт (необязательно)">
    @error('label') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="row" style="gap:16px;">
    <div class="field" style="min-width: 160px;">
        <label for="check_method">Метод</label>
        <select id="check_method" name="check_method" style="padding:10px 12px; border-radius:10px; border:1px solid #33466f; background:#0b1220; color:#e5e7eb;">
            @php $method = old('check_method', optional($domain)->check_method ?? 'HEAD'); @endphp
            <option value="HEAD" {{ $method === 'HEAD' ? 'selected' : '' }}>HEAD</option>
            <option value="GET" {{ $method === 'GET' ? 'selected' : '' }}>GET</option>
        </select>
        @error('check_method') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field" style="min-width: 220px;">
        <label for="check_interval_minutes">Интервал (мин)</label>
        <input id="check_interval_minutes" name="check_interval_minutes" type="number" min="1" max="1440"
               value="{{ old('check_interval_minutes', optional($domain)->check_interval_minutes ?? 5) }}" required>
        @error('check_interval_minutes') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field" style="min-width: 220px;">
        <label for="timeout_seconds">Таймаут (сек)</label>
        <input id="timeout_seconds" name="timeout_seconds" type="number" min="1" max="60"
               value="{{ old('timeout_seconds', optional($domain)->timeout_seconds ?? 10) }}" required>
        @error('timeout_seconds') <div class="error">{{ $message }}</div> @enderror
    </div>
</div>

<div class="field" style="flex-direction:row; align-items:center; gap:10px;">
    @php $active = old('is_active', optional($domain)->is_active ?? true); @endphp
    <input id="is_active" name="is_active" type="checkbox" value="1" {{ $active ? 'checked' : '' }}>
    <label for="is_active" class="muted">Активен</label>
    @error('is_active') <div class="error">{{ $message }}</div> @enderror
</div>

