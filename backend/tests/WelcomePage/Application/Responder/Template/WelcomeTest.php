<?php

declare(strict_types=1);

namespace Tests\WelcomePage\Application\Responder\Template;

use Tests\TestCase;

final class WelcomeTest extends TestCase
{
    public function testWelcomePage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
