<?php

namespace App\Users\Infrastructure\Controller;

use App\Shared\Infrastructure\Controller\ApiController as BaseApiController;
use App\Users\Infrastructure\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/api')]
class APIController extends BaseApiController
{
    #[Route('/login/login_check', methods: ['GET'])]
    public function getUserToken(UserInterface $user, JWTTokenManagerInterface $tokenManager): JsonResponse
    {
        $userToken = $tokenManager->create($user);

        $jsonResponse = new JsonResponse(['token' => $userToken]);
        $jsonResponse->headers->setCookie(Cookie::create('usr_token', $userToken, time() + 3600));

        return $jsonResponse;
    }

    #[Route('/profile/me', methods: ['POST'])]
    public function getUserInfo(UserInterface $user): JsonResponse
    {
        return new JsonResponse(
            $user->getData()
        );
    }

    #[Route('/access/developer', methods: ['GET'])]
    public function isDeveloper(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_DEVELOPER');
        return $this->respondWithSuccess('Access granted');
    }

    #[Route('/access/admin', methods: ['GET'])]
    public function isAdmin(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->respondWithSuccess('Access granted');
    }
}