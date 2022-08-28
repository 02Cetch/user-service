<?php

namespace App\Users\Infrastructure\Controller;

use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Infrastructure\Controller\ApiController as BaseApiController;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class APIController extends BaseApiController
{
    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }

    #[Route('/login/login_check', methods: ['GET'])]
    public function getUserToken(JWTTokenManagerInterface $tokenManager): JsonResponse
    {
        $user = $this->userFetcher->getAuthUser();
        $userToken = $tokenManager->create($user);

        $jsonResponse = new JsonResponse(['token' => $userToken]);
        $jsonResponse->headers->setCookie(Cookie::create('usr_token', $userToken, time() + 3600));

        return $jsonResponse;
    }

    #[Route('/profile/me', methods: ['POST'])]
    public function getUserInfo(): JsonResponse
    {
        $user = $this->userFetcher->getAuthUser();

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
