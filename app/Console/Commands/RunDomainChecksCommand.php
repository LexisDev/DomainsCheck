<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Services\Monitoring\DomainCheckService;
use Illuminate\Console\Command;

class RunDomainChecksCommand extends Command
{
    protected $signature = 'domains:check';

    protected $description = 'Выполнить проверки доступности доменов';

    /**
     * @var DomainCheckService
     */
    private $checkService;

    public function __construct(DomainCheckService $checkService)
    {
        $this->checkService = $checkService;
        parent::__construct();
    }

    public function handle(): int
    {
        $domains = Domain::query()
            ->where('is_active', true)
            ->orderBy('id')
            ->get();

        if ($domains->isEmpty()) {
            $this->info('Нет активных доменов для проверки.');
            return self::SUCCESS;
        }

        $now = now();
        $processed = 0;

        foreach ($domains as $domain) {
            if ($this->shouldSkip($domain, $now)) {
                continue;
            }

            $this->line("Проверка {$domain->host}...");
            $this->checkService->check($domain);
            $processed++;
        }

        $this->info("Готово, выполнено проверок: {$processed}");

        return self::SUCCESS;
    }

    private function shouldSkip(Domain $domain, \Illuminate\Support\Carbon $now): bool
    {
        if ($domain->last_checked_at === null) {
            return false;
        }

        return $domain->last_checked_at->gt(
            $now->copy()->subMinutes($domain->check_interval_minutes)
        );
    }
}

