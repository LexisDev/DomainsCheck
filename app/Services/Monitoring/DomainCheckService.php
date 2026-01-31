<?php

namespace App\Services\Monitoring;

use App\Models\Domain;
use App\Models\DomainCheck;
use Illuminate\Support\Facades\Http;

class DomainCheckService
{
    public function check(Domain $domain): DomainCheck
    {
        $url = $this->buildUrl($domain->host);

        $startedAt = microtime(true);
        $statusCode = null;
        $isSuccess = false;
        $error = null;

        try {
            $request = Http::timeout($domain->timeout_seconds)
                ->retry(1, 200)
                ->withHeaders([
                    'User-Agent' => 'DomainMonitor/1.0',
                ]);

            $response = $domain->check_method === 'GET'
                ? $request->get($url)
                : $request->head($url);

            $statusCode = $response->status();
            $isSuccess = $response->successful();
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }

        $finishedAt = microtime(true);

        $check = new DomainCheck([
            'checked_at' => now(),
            'status_code' => $statusCode,
            'is_success' => $isSuccess,
            'response_time_ms' => (int) (($finishedAt - $startedAt) * 1000),
            'error_message' => $error,
        ]);

        $check->domain()->associate($domain);
        $check->save();

        $domain->forceFill([
            'last_checked_at' => $check->checked_at,
        ])->save();

        return $check;
    }

    private function buildUrl(string $host): string
    {
        $trimmed = trim($host);

        if (! str_starts_with($trimmed, 'http://') && ! str_starts_with($trimmed, 'https://')) {
            $trimmed = 'http://' . $trimmed;
        }

        return $trimmed;
    }
}

