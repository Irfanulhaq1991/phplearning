<?php

namespace Irfan\Phplearning\model;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepo extends EntityRepository
{

    public function saveUser(User $user): bool
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return $user->getId() !== null && $user->getId() > 0;
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->findOneBy([
            "email" => @$email
        ]);
    }
}