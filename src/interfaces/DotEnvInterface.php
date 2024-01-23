<?php

declare(strict_types=1);

namespace UtilityCore\Interfaces;

interface DotEnvInterface
{
    public function load(): void;
    public function get(string $key, string $default = null): ?string;
    public function getData(): array;
    public function clearData(): void;
}
