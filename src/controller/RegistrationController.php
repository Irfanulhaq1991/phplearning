<?php

namespace Irfan\Phplearning\controller;

use Doctrine\ORM\EntityManagerInterface;
use http\Exception\UnexpectedValueException;
use Irfan\Phplearning\model\User;
use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\view\RegistrationPresenter;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class RegistrationController
{
    public function __construct(
       private readonly RegistrationPresenter   $registrationView,
        private readonly Environment            $twig,
        private readonly EntityManagerInterface $entityManager,

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
        $this->registrationView->render($token);
/*        $this->twig->display("registration.twig", ["token" => $token]);*/
    }

    public function register(array $formData): void
    {
        if ($formData["token"] == $_SESSION["csrf_token"]) {
            $firstName = htmlspecialchars($formData["first_name"] ?? '');
            $lastName = htmlspecialchars($formData["lastName_name"] ?? '');
            $email = htmlspecialchars($formData["email"] ?? '');
            $password = htmlspecialchars($formData["password"] ?? '');
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setPassword($password);
            $repo = UserRepo::instantiate($this->entityManager);
            $isSuccess = $repo->saveUser($user);
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