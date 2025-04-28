<?php

declare(strict_types=1);

namespace Tests\System\HealthCheck\Presentation\Http\Controller;

use Tests\TestCase;

class HealthcheckControllerTest extends TestCase
{
    /**
     * Тестируем выполнение проверки работоспособности сервера
     */
    public function testStatus(): void
    {
        $response = $this->get('/healthcheck');

        $response->assertStatus(200);
    }
}
