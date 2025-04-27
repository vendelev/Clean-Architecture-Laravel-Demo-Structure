<?php

declare(strict_types=1);

namespace Tests\Core\Presentation\Http\Controller;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

final class OpenApiControllerTest extends TestCase
{
    /**
     * Проверим генерацию swagger.json
     */
    public function testGenerateOpenApiJsonFile(): void
    {
        $path = Config::get('l5-swagger.defaults.paths.docs');
        $file = Config::get('l5-swagger.documentations.default.paths.docs_json');
        $filePath = $path . DIRECTORY_SEPARATOR . $file;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        Artisan::call('l5-swagger:generate');
        self::assertFileExists($filePath);
    }


}
