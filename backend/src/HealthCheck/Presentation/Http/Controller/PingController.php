<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Presentation\Http\Controller;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use Spatie\RouteAttributes\Attributes as Route;

final readonly class PingController
{
    public function __construct(
        private ResponseFactory $response
    ) {
    }

    #[Route\Get(uri:'/ping')]
    #[OA\Get(path: '/ping', description: 'Проверка доступности', tags: ['Internal'])]
    #[OA\Response(response: 200, description: 'pong')]
    public function ping(): Response
    {
        return $this->response->make('pong');
    }
}
