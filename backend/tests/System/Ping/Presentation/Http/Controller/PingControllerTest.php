<?php

declare(strict_types=1);

namespace Tests\System\Ping\Presentation\Http\Controller;

use Tests\TestCase;

class PingControllerTest extends TestCase
{
    /**
     * Проверим вывод pong
     */
    public function testPing(): void
    {
        self::assertEquals('pong', $this->get('/ping')->content());
    }
}
