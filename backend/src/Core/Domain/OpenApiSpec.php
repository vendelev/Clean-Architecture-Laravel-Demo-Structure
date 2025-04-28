<?php

declare(strict_types=1);

namespace CleanStructure\Core\Domain;

use OpenApi\Attributes as OA;

/**
 * @see https://zircote.github.io/swagger-php/guide/examples.html
 * @see https://zircote.github.io/swagger-php/reference/attributes.html
 * @see https://zircote.github.io/swagger-php/guide/cookbook.html#default-security-scheme-for-all-endpoints
 * @see https://learn.openapis.org/specification/paths.html
 */
#[OA\Info(
    version: '1.0.0',
    title: 'Универсальная структура проекта на примере Laravel',
)]
#[OA\Components(
    securitySchemes: [
        new OA\SecurityScheme(
            securityScheme: 'bearerAuth',
            type: 'http',
            name: 'Authorization',
            in: 'header',
            bearerFormat: 'JWT',
            scheme: 'bearer'
        )
    ]
)]
#[OA\OpenApi(
    security: [['bearerAuth' => []]]
)]
final readonly class OpenApiSpec
{
}
