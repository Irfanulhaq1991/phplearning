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

    public function findUserByEmail(string $email): ?User
    {
        return $this->findOneBy([
            "email" => $email
        ]);
    }
    public function findUserById(string $id): ?User
    {
        return $this->findOneBy([
            "id" => $id
        ]);
    }

    public function addUserGroup(User $user, Group $group)
    {
        $userGroups = $user->getGroups();
        if (!$userGroups->contains($group)) {
            $userGroups->add($group);
        }

        $this->getEntityManager()->flush();
    }

    public function deleteUserGroupById(User $user,Group $group):bool
    {
        $userGroups = $user->getGroups();
        $groupUsers = $group->getUsers();
        if ($userGroups->contains($group)) {
            $userGroups->removeElement($group);
        }

        $this->getEntityManager()->flush();
        $userGroups = $user->getGroups();
        return !($userGroups->contains($group));
    }
}