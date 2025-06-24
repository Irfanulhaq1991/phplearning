<?php

namespace Irfan\Phplearning\routing;

use Flight;
use Irfan\Phplearning\controller\JoinGroupController;
use Irfan\Phplearning\controller\LoginController;
use Irfan\Phplearning\controller\RegistrationController;
use Irfan\Phplearning\controller\DashboardController;

readonly class FlightRouter implements RouterContract
{

    public function __construct(
        private RegistrationController $registrationController,
        private LoginController        $loginController,
        private DashboardController    $dashboardController,
        private JoinGroupController    $joinGroupController
    )
    {
    }

    function registerRouts(): void
    {

        Flight::route('/', function () {
            $this->loginController->start();
        });

        Flight::route('POST /submit-registration', function () {
            $formData = Flight::request()->data->getData();
            $this->registrationController->register($formData);
        });

        Flight::route('/login', function () {
            $this->loginController->start();
        });

        Flight::route('POST /submit-login', function () {
            $formData = Flight::request()->data->getData();
            $this->loginController->login($formData);
        });

        Flight::route('/registration', function () {
            $this->registrationController->start();
        });

        Flight::route('/dashboard', function () {
            $this->dashboardController->start();
        });
        Flight::route('/join-group', function () {
            $this->joinGroupController->start();
        });

        Flight::route('/logout', function () {
            $this->dashboardController->logoutUser();
        });

        Flight::route('/join/@groupId', function ($groupId) {
            $this->joinGroupController->joinGroup($groupId);
        });


        Flight::start();
    }
}