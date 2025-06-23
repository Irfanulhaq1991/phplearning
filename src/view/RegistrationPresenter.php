<?php

namespace Irfan\Phplearning\view;

use Twig\Environment;

class RegistrationPresenter
{
    public function __construct(private readonly Environment $twig)
    {}
        public function render(string $token): void
    {
        $this->twig->display("registration.twig", ["token" => $token]);
    }


}