<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Presentation\Config;

use CleanStructure\HealthCheck\Presentation\Listener\HealthChecker;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Support\ServiceProvider;

final class HealthCheckServiceProvider extends ServiceProvider
{
    /**
     * Загрузка служб приложения
     */
    public function boot(): void
    {
        $this->app->get(Dispatcher::class)->listen(events: [DiagnosingHealth::class], listener: HealthChecker::class);
    }
}
