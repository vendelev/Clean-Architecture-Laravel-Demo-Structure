<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Presentation\Listener;

use CleanStructure\HealthCheck\Application\UseCase\DbHealthUseCase;
use Illuminate\Foundation\Events\DiagnosingHealth;

final readonly class HealthChecker
{
    public function __construct(
        private DbHealthUseCase $dbHealthUseCase
    ) {
    }

    /**
     * Точка входа в модуль проверки работоспособности внешних ресурсов
     *
     * @SuppressWarnings(UnusedFormalParameter)
     */
    public function handle(DiagnosingHealth $event): bool
    {
        return $this->dbHealthUseCase->check();
    }
}
