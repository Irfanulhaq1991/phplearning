<?php

namespace Irfan\Phplearning\view;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class RegistrationPresenter
{
    public function __construct(private readonly Environment $twig)
    {}

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function render(string $token): void
    {
        $this->twig->display("registration.twig", ["token" => $token]);
    }


}