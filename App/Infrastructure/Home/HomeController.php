<?php

declare(strict_types=1);

namespace App\Infrastructure\Home;

use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Get;
use Symfony\Component\HttpFoundation\Response;

final class HomeController
{
    #[Get(uri: '/', name: 'api.v1.home')]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Welcome to the Laravel API Starter Kit Homepage',
            'code' => Response::HTTP_OK,
        ]);
    }
}
