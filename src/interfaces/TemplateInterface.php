<?php

declare(strict_types=1);

namespace UtilityCore\Interfaces;

use Illuminate\View\Factory;

interface TemplateInterface
{
    public function getViewFactory(): Factory;
}
