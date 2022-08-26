<?php

namespace App\Users\Infrastructure\Controller;
use App\Shared\Infrastructure\Controller\ApiController;
use App\Users\Domain\Factory\UserFactory;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Users\Infrastructure\Service\UserPasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthController extends ApiController
{
    #[Route('/register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $basePasswordHasher,
                             EntityManagerInterface $entityManager): JsonResponse
    {
        $jsonRequest = $this->transformJsonBody($request);

        $login = $jsonRequest->get('login');
        $password = $jsonRequest->get('password');

        if (empty($login) || empty($password)) {
            return $this->respondValidationError("Invalid credentials");
        }

        $user = (new UserFactory(new UserPasswordHasher($basePasswordHasher)))->create($login, $password);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->respondWithSuccess("User {$user->getLogin()} successfully created");
    }


    #[Route('/api/login/login_check', methods: ['GET'])]
    public function getUserToken(UserInterface $user, JWTTokenManagerInterface $tokenManager): JsonResponse
    {
//        $userToken = $tokenManager->create($user);
//
//        $jsonResponse = new JsonResponse(['token' => $userToken]);
//        $jsonResponse->headers->setCookie(Cookie::create('usr_token', $userToken, time() + 3600));
//
//        return $jsonResponse;
    }
}