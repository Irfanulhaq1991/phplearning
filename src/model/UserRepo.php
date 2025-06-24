<?php

namespace Irfan\Phplearning\model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
            "email" => $email
        ]);
    }

    public function addUserGroup(User $user, Group $group)
    {
        $userGroups = $user->getGroups();
        $groupUsers = $group->getUsers();
        if (!$userGroups->contains($group) && !$groupUsers->contains($user)) {
            $userGroups->add($group);
            $groupUsers->add($user);
        }

        $this->getEntityManager()->flush();
    }

    public function getUserGroups(string $Id):Collection
    {

    }
}