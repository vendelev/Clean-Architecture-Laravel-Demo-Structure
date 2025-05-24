<?php

declare(strict_types=1);

namespace Tests\ModuleSuite\HealthCheck\Presentation\Http\Controller;

use Tests\TestCase;

final class PingControllerTest extends TestCase
{
    /**
     * Тестируем проверку доступности сервера
     */
    public function testPing(): void
    {
        self::assertEquals('pong', $this->get('/ping')->content());
    }
}
