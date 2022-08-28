<?php

namespace App\Shared\Infrastructure\Service;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use Symfony\Component\Security\Core\Security;
use Webmozart\Assert\Assert;

class UserFetcher implements UserFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getAuthUser(): AuthUserInterface
    {
        /* @var AuthUserInterface $user */
        $user = $this->security->getUser();

        Assert::notNull($user, 'User not found');
        Assert::isInstanceOf($user, AuthUserInterface::class, 'User class not implements AuthUserInterface');

        return $user;
    }
}
