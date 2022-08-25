<?php

namespace App\Users\Infrastructure\Controller;

use App\Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', methods: ['GET'])]
class TestController extends ApiController
{
    #[Route('/user', methods: ['GET'])]
    public function testAction(): JsonResponse
    {
        return $this->respondWithSuccess('Validation success');
    }
}