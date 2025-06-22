<?php

namespace Irfan\Phplearning\controller;

use http\Exception\UnexpectedValueException;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class LoginController
{
    public function __construct(private readonly Environment $twig)
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
        $this->twig->display("login.twig", ["token" => $token]);
    }

    public function login(array $formData): void
    {
        if($formData["token"] == $_SESSION["csrf_token"])
            echo $formData["token"];
        echo $formData["email"];
        echo $formData["password"];

    }
}