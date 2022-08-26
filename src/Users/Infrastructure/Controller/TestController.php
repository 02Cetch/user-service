<?php

namespace App\Users\Infrastructure\Controller;

use App\Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/test', methods: ['GET'])]
class TestController extends ApiController
{
    #[Route('/user', methods: ['GET'])]
    public function testAction(UserInterface $user): JsonResponse
    {
        var_dump($user->getLogin());
        return $this->respondWithSuccess('Validation success');
    }
}