<?php

namespace Irfan\Phplearning\view;

use Twig\Environment;

class JoinGroupPresenter extends BasePresenter
{
    public function __construct(private readonly Environment $twig)
    {
        parent::__construct($this->twig);
    }


    function displayLayout(array $data = []): void
    {
        $this->render('join_group',$data);
    }
}