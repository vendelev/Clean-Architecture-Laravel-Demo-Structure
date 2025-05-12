<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Presentation\Config;

use CleanStructure\HealthCheck\Presentation\Listener\HealthChecker;
use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

final class HealthCheckServiceProvider extends ServiceProvider
{
    /**
     * Загрузка служб приложения
     */
    public function boot(): void
    {
        Event::listen(events: [DiagnosingHealth::class], listener: HealthChecker::class);
    }
}
