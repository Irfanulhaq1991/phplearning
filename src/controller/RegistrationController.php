<?php

namespace Irfan\Phplearning\controller;

use http\Exception\UnexpectedValueException;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RegisterationController
{

    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../view');
        $this->twig = new Environment($loader);
    }

   public function renderRegisterUI()
    {
        $this->twig->display("registration.twig");
    }
}