<?php

namespace Irfan\Phplearning;

use Irfan\Phplearning\routing\RouterContract;

readonly class App
{

    public function __construct(private RouterContract $router)
    {}

    public function start(): void
    {
        $this->router->registerRouts();
    }

}