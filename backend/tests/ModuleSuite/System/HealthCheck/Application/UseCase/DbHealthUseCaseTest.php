<?php

declare(strict_types=1);

namespace Tests\ModuleSuite\System\HealthCheck\Application\UseCase;

use CleanStructure\HealthCheck\Application\UseCase\DbHealthUseCase;
use Tests\TestCase;

final class DbHealthUseCaseTest extends TestCase
{
    /**
     * Проверим позитивный сценарий
     */
    public function testSuccessCheck(): void
    {
        self::assertTrue($this->service(DbHealthUseCase::class)->check());
    }
}
