<?php

declare(strict_types=1);

namespace UtilityCore\Interfaces;

use Illuminate\Routing\Router;

interface RouterInterface
{
    public function getRouter(): Router;
}
