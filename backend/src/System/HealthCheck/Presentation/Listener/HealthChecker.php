<?php

declare(strict_types=1);

namespace CleanStructure\System\HealthCheck\Presentation\Listener;

use CleanStructure\System\HealthCheck\Application\UseCase\DbHealthUseCase;
use Illuminate\Foundation\Events\DiagnosingHealth;

final readonly class HealthChecker
{
    public function __construct(
        private DbHealthUseCase $dbHealthUseCase
    ) {
    }

    /**
     * Точка входа в модуль проверки доступности внешних ресурсов
     *
     * @SuppressWarnings(UnusedFormalParameter)
     * @param DiagnosingHealth $event
     * @return bool
     */
    public function handle(DiagnosingHealth $event): bool
    {
        return $this->dbHealthUseCase->check();
    }
}
