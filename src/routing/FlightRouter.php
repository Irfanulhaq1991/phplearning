<?php

namespace Irfan\Phplearning\routing;

use Flight;
use Irfan\Phplearning\controller\LoginController;
use Irfan\Phplearning\controller\RegistrationController;

readonly class FlightRouter implements RouterContract
{

    public function __construct(
        private RegistrationController $registrationController,
        private LoginController        $loginController,
    )
    {}

    function registerRouts():void
    {

        Flight::route('/', function() {
            $this->registrationController->render();
        });

        Flight::route('POST /submit-registration', function(){
            $formData = Flight::request()->data->getData();
            @$this->registrationController->register($formData);
        });

        Flight::route('/login', function(){
            $formData = Flight::request()->data->getData();
            @$this->loginController->render($formData);
        });

        Flight::route('POST /submit-login', function(){
            $formData = Flight::request()->data->getData();
            @$this->loginController->login($formData);
        });
        Flight::start();
    }
}