<?php

declare(strict_types=1);

namespace Tests\System\HealthCheck\Application\UseCase;

use CleanStructure\System\HealthCheck\Application\UseCase\DbHealthUseCase;
use Tests\TestCase;

class DbHealthUseCaseTest extends TestCase
{
    /**
     * Проверим позитивный сценарий
     */
    public function testSuccessCheck(): void
    {
        self::assertTrue($this->service(DbHealthUseCase::class)->check());
    }
}
