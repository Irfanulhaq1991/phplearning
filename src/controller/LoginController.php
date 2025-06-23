<?php

namespace Irfan\Phplearning\controller;

use Doctrine\ORM\EntityManagerInterface;
use http\Exception\UnexpectedValueException;
use Irfan\Phplearning\model\User;
use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\view\LoginPresenter;
use Irfan\Phplearning\view\RegistrationPresenter;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class LoginController
{
    public function __construct(
        private readonly LoginPresenter $loginPresenter,
        private readonly Environment    $twig,
        private readonly UserRepo       $userRepo,
    )
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function render(): void
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION["csrf_token"] = $token;
        $this->loginPresenter->render($token);
    }

    public function login(array $formData): void
    {
        if($formData["token"] == $_SESSION["csrf_token"]) {
            echo $formData["token"];
            $email = htmlspecialchars($formData["email"]??'');
            $password = htmlspecialchars($formData["password"]??'');
            $user = $this->userRepo->getUserByEmail($email);
            if($user && $user->comparePassword($password)){
                echo "Login is successful";
            }else{
                echo "Login is unsuccessful";
            }
        }

    }

    public function logout()
    {


    }
}