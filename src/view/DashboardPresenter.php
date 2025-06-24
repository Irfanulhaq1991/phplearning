<?php

namespace Irfan\Phplearning\view;

use Irfan\Phplearning\model\User;
use Irfan\Phplearning\utilities\SecurityUtility;
use Twig\Environment;

class DashboardPresenter extends BasePresenter
{
    public function __construct(
        private readonly Environment $twig,
        private readonly SecurityUtility $securityUtility
    )
    {
        parent::__construct($this->twig);
    }


    function displayLayout(array $data = []): void
    {
        $formatedData = $this->formateData($data);
        $this->render('dashboard', $formatedData);
    }

    private function formateData(array $data):array{
        $user = $data[0] ?? new User();
        $fullName = "{$this->securityUtility->escapeHtml($user->getFirstName())} {$this->securityUtility->escapeHtml($user->getLastName())}";
        return [
            "user" => $user,
            "full_name" =>$fullName
        ];
    }
}