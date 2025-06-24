<?php

namespace Irfan\Phplearning\controller;


use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\utilities\SecurityUtility;
use Irfan\Phplearning\utilities\SessionManagerContract;
use Irfan\Phplearning\view\JoinGroupPresenter;
use Irfan\Phplearning\view\LoginPresenter;
use Irfan\Phplearning\view\UserGroupsPresenter;

class JoinGroupController extends BaseController
{
    public function __construct(
        private readonly JoinGroupPresenter $presenter,
        private readonly SessionManagerContract $sessionManager,
    )
    {
        parent::__construct($this->sessionManager);
    }

    public function start(): void
    {
        $this->presenter->displayLayout();
    }
}