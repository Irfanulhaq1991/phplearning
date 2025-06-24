<?php

namespace Irfan\Phplearning\view;

use Twig\Environment;

class DashboardPresenter extends BasePresenter
{
    public function __construct(
        private readonly Environment $twig
    )
    {
        parent::__construct($this->twig);
    }


    function displayLayout(array $data = []): void
    {
        $this->render('dashboard',$data);
    }
}