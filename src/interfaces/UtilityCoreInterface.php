<?php

declare(strict_types=1);

namespace UtilityCore\Interfaces;

interface UtilityCoreInterface
{
    public function getContainer(): object;
    public function getDotEnv(): object;
    public function getDb(): object;
    public function getUtil(int $util, ...$args): void;
}
