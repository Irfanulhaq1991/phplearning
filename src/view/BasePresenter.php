<?php

namespace Irfan\Phplearning\view;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class BasePresenter
{

    abstract function displayLayout(array $data = []):void;

    public function __construct(private readonly Environment $twig)
    {}

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function render(string $template, array $data): void
    {
        $this->twig->display($template.'.twig', $data);
    }
}