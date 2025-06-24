<?php

namespace Irfan\Phplearning\controller;


use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\utilities\SecurityUtility;
use Irfan\Phplearning\utilities\SessionManagerContract;
use Irfan\Phplearning\view\LoginPresenter;
use Irfan\Phplearning\view\UserGroupsPresenter;

class UserGroupsController extends BaseController
{
    public function __construct(
        private readonly UserGroupsPresenter $presenter,
        private readonly SessionManagerContract $sessionManager,
    )
    {
        parent::__construct($this->sessionManager);
    }

    public function render(): void
    {
        $this->presenter->render();
    }

    public function logoutUser()
    {
      $this->sessionManager->clear();
    }
}