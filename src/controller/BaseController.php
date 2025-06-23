<?php

namespace Irfan\Phplearning\controller;

use Irfan\Phplearning\utilities\SessionManagerContract;

abstract class BaseController
{
    public function __construct(SessionManagerContract $sessionManager)
    {
        $sessionManager->startSession();
    }
}