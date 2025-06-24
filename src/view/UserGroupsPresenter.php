<?php

namespace Irfan\Phplearning\view;

use Twig\Environment;

class UserGroupsPresenter extends BasePresenter
{
    public function __construct(private readonly Environment $twig)
    {
        parent::__construct($this->twig);
    }


}