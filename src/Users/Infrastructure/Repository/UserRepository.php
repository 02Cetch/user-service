<?php

namespace App\Users\Infrastructure\Repository;

use App\Users\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }

    public function findByLogin(string $login)
    {
        return $this->findOneBy(['login' => $login]);
    }
}
