<?php

namespace Irfan\Phplearning\model;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepo extends EntityRepository
{
    /**
     * @noinspection PhpIncompatibleReturnTypeInspection
     * @param EntityManagerInterface $entityManager
     * @return UserRepo
     */
    public static function instantiate(EntityManagerInterface $entityManager): UserRepo
    {
        return $entityManager->getRepository(User::class);
    }
    public function saveUser(User $user):bool
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return $user->getId() !== null && $user->getId() > 0;
    }
    public function getUserByEmail(string $email):User
    {
        return $this->findOneBy([
            "email"=> @$email
        ]);
    }
}