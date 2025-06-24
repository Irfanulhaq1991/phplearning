<?php

namespace Irfan\Phplearning\view;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class BasePresenter
{


    public function __construct(private readonly Environment $twig)
    {}

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function render(string $template,array $data = []): void
    {
        $this->twig->display($template,$data);
    }
}