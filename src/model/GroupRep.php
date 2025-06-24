<?php

namespace Irfan\Phplearning\model;

use Doctrine\ORM\EntityRepository;

class GroupRep extends EntityRepository
{

    public function findGroupById(int $id):?Group
    {
        return $this->findOneBy([
            "id" => $id
        ]);
    }
}