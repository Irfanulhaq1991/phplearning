<?php

namespace Irfan\Phplearning\routing;

class RouterManager
{
    public function __construct(private readonly RouterContract $router)
    {}

    function init():void{
        $this->router->registerRouts();
    }

}