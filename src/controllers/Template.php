<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use UtilityCore\Interfaces\TemplateInterface;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Events\Dispatcher;

class Template implements TemplateInterface
{
    private $viewFactory;

    public function __construct(string $viewPath, string $cachePath)
    {
        $fileViewFinder = new FileViewFinder(new Filesystem(), [$viewPath]);
        $engineResolver = new EngineResolver();
        $dispatcher = new Dispatcher();

        $bladeCompiler = new BladeCompiler(new Filesystem(), $cachePath);
        $engineResolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $this->viewFactory = new Factory(
            $engineResolver,
            $fileViewFinder,
            $dispatcher
        );
    }

    public function getViewFactory(): Factory
    {
        return $this->viewFactory;
    }
}
