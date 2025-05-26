<?php

declare(strict_types=1);

namespace Tests\ModuleSuite\Core\Presentation\Http\Controller;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Console\Kernel;
use Tests\TestCase;

final class OpenApiControllerTest extends TestCase
{
    /**
     * Проверим генерацию swagger.json
     */
    public function testGenerateOpenApiJsonFile(): void
    {
        $config = $this->service(Config::class);
        $kernel = $this->service(Kernel::class);

        $path = $config->get('l5-swagger.defaults.paths.docs');
        $file = $config->get('l5-swagger.documentations.default.paths.docs_json');
        $filePath = $path . DIRECTORY_SEPARATOR . $file;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $kernel->call('l5-swagger:generate');
        $url = $config->get('l5-swagger.defaults.routes.docs');

        $response = $this->get('/' . $url);
        $response->assertStatus(200);
        self::assertStringEqualsFile($filePath, $response->content());
        self::assertArrayHasKey('/ping', $response->json()['paths']);
    }
}
