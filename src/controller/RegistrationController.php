<?php

namespace Irfan\Phplearning\controller;

use Doctrine\ORM\EntityManagerInterface;
use http\Exception\UnexpectedValueException;
use Irfan\Phplearning\model\User;
use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\utilities\SecurityUtility;
use Irfan\Phplearning\utilities\SessionManagerContract;
use Irfan\Phplearning\view\RegistrationPresenter;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class RegistrationController extends BaseController
{
    public function __construct(
        private readonly RegistrationPresenter  $registrationView,
        private readonly UserRepo       $userRepo,
        private readonly SessionManagerContract $sessionManager,
        private readonly SecurityUtility  $securityUtility
    )
    {
        parent::__construct($this->sessionManager);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function render(): void
    {
        $token = $this->securityUtility->createCsrfToken();
        $this->registrationView->render($token);
    }

    public function register(array $userInfo): void
    {
        $receivedCrsfToken = $userInfo["token"]??'';
        $isCsrfTokenValid = $this->securityUtility->checkTokenValidity($receivedCrsfToken);

        if ($isCsrfTokenValid) {

            $isSuccess = $this->userRepo->saveUser($userInfo);
            if ($isSuccess) {
                header('Location: /login');
                exit();
            } else {
                echo "Not able to register";
            }
        } else {
            echo "error occured";
        }
    }
}