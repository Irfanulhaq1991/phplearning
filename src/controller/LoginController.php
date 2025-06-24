<?php

namespace Irfan\Phplearning\controller;


use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\utilities\SecurityUtility;
use Irfan\Phplearning\utilities\SessionManagerContract;
use Irfan\Phplearning\view\LoginPresenter;


class LoginController extends BaseController
{
    public function __construct(
        private readonly LoginPresenter         $loginPresenter,
        private readonly UserRepo               $userRepo,
        private readonly SessionManagerContract $sessionManager,
        private readonly SecurityUtility        $securityUtility
    )
    {
        parent::__construct($this->sessionManager);
    }

    public function start(): void
    {
        $token = $this->securityUtility->createCsrfToken();
        $this->loginPresenter->render($token);
    }

    /**
     * @param array $formData
     * @return void
     */
    public function login(array $formData): void
    {
        $receivedCrsfToken = $formData["token"] ?? '';
        $email = $formData["email"] ?? '';
        $password = $formData["password"] ?? '';
        $isCsrfTokenValid = $this->securityUtility->checkTokenValidity($receivedCrsfToken);
        if ($isCsrfTokenValid) {
            $user = $this->userRepo->getUserByEmail($email);
            if ($user && $user->comparePassword($password)) {
                header('Location:/user-groups');
                exit();
            } else {
                echo "Login is unsuccessful";
            }
        }

    }

    public function logout()
    {

    }

}