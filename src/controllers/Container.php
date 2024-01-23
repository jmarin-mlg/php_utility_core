<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use Exception;

class Container
{
    protected $bindings  = [];
    protected $instances = [];

    public function bind(string $abstract, $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function resolve(string $abstract, ...$args): object
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];
            if ($concrete instanceof \Closure) {
                $instance = $concrete($this);
            } else {
                $instance = new $concrete(...$args);
            }

            $this->instances[$abstract] = $instance;

            return $instance;
        }

        throw new Exception("No implementation found for [$abstract]");
    }

    public function getContainer(): object
    {
        return (object) $this->bindings;
    }

    public function clearBindings(): void
    {
        $this->bindings  = [];
        $this->instances = [];
    }
}
