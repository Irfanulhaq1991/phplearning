<?php

namespace Irfan\Phplearning\model;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepo extends EntityRepository
{

    public function saveUser(array $userInfo): bool
    {
        $firstName = $userInfo["first_name"];
        $lastName = $userInfo["lastName_name"];
        $email = $userInfo["email"];
        $password = $userInfo["password"];

        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setPassword($password);

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