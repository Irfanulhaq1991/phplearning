<?php

namespace Irfan\Phplearning\controller;


use Irfan\Phplearning\model\GroupRep;
use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\utilities\AppSessionKeys;
use Irfan\Phplearning\utilities\SecurityUtility;
use Irfan\Phplearning\utilities\SessionManagerContract;
use Irfan\Phplearning\view\LoginPresenter;
use Irfan\Phplearning\view\DashboardPresenter;

class DashboardController extends BaseController
{
    public function __construct(
        private readonly DashboardPresenter     $presenter,
        private readonly UserRepo               $userRepo,
        private readonly GroupRep               $groupRepo,
        private readonly SessionManagerContract $sessionManager,
    )
    {
        parent::__construct($this->sessionManager);
    }

    public function start(): void
    {
        $userId = $this->sessionManager->getValue(AppSessionKeys::USER_ID_KEY);
        $user = [$this->userRepo->findUserById($userId)];
//        $data = [
//            "user" => $user
//        ];
        $this->presenter->displayLayout($user);
    }

    public function logoutUser(): void
    {
        $this->sessionManager->clear();
        header('Location:/');
        exit();
    }

    public function deleteUserGroup(int $groupId): void
    {
        $userId = $this->sessionManager->getValue(AppSessionKeys::USER_ID_KEY);
        $group = $this->groupRepo->findGroupById($groupId);
        $user = $this->userRepo->findUserById($userId);
        $isDeleted = $this->userRepo->deleteUserGroupById($user, $group);
        if ($isDeleted) {
            header('Location:/dashboard');
            exit();
        }
    }
}