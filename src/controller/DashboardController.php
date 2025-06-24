<?php

namespace Irfan\Phplearning\controller;


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
        private readonly SessionManagerContract $sessionManager,
    )
    {
        parent::__construct($this->sessionManager);
    }

    public function start(): void
    {
        $userId = $this->sessionManager->getValue(AppSessionKeys::USER_ID_KEY);
        $user = $this->userRepo->findUserById($userId);
        $data = [
            "user" => $user
        ];
        $this->presenter->displayLayout($data);
    }

    public function logoutUser(): void
    {
        $this->sessionManager->clear();
        header('Location:/');
        exit();
    }
}