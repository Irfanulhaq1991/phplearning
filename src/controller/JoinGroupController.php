<?php

namespace Irfan\Phplearning\controller;


use Irfan\Phplearning\model\GroupRep;
use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\utilities\AppSessionKeys;
use Irfan\Phplearning\utilities\SessionManagerContract;
use Irfan\Phplearning\view\JoinGroupPresenter;


class JoinGroupController extends BaseController
{
    public function __construct(
        private readonly JoinGroupPresenter $presenter,
        private readonly SessionManagerContract $sessionManager,
        private readonly GroupRep $groupRep,
        private readonly UserRepo $userRepo
    )
    {
        parent::__construct($this->sessionManager);
    }

    public function start(): void
    {
        $groups = $this->groupRep->findAll();

        $this->presenter->displayLayout($groups);
    }
    public function joinGroup(int $groupId):void
    {
        $userId = $this->sessionManager->getValue(AppSessionKeys::USER_ID_KEY);
        $group = $this->groupRep->findGroupById($groupId);
        $user = $this->userRepo->findUserById($userId);
        if($user && $group){
            $this->userRepo->addUserGroup($user,$group);
            header('Location:/dashboard');
            exit();
        }
    }
}