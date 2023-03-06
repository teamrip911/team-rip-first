<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test-check', name: 'test_check', methods: ['GET'])]
class TestCheckAction
{
    public function __invoke(): Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
