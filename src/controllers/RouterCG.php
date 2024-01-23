<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use UtilityCore\Interfaces\RouterInterface;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;

class RouterCG implements RouterInterface
{
    private $router;

    public function __construct()
    {
        $container    = new Container();
        $dispatcher   = new Dispatcher($container);
        $this->router = new Router($dispatcher, $container);
    }

    public function getRouter(): Router
    {
        return $this->router;
    }
}
