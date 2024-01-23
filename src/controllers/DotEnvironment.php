<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use UtilityCore\Interfaces\DotEnvInterface;
use Exception;

class DotEnvironment implements DotEnvInterface
{
    private $filePath;
    private $data;

    public function __construct(string $filePath)
    {
        $filePath = strtolower($filePath);

        if (!file_exists($filePath) || !is_file($filePath)) {
            throw new Exception(
                "The file `$filePath` does not exist or it is not a file"
            );
        }

        // Verifico que el fichero tenga permisos de lectura
        if (!is_readable($filePath)) {
            throw new Exception(
                "The file `$filePath` does not have read permissions and is not
                accessible"
            );
        }

        $this->filePath = $filePath;
        $this->data = [];
    }

    public function load(): void
    {
        $this->clearData();
        $this->data = parse_ini_file(strtolower($this->filePath));
    }

    public function get(string $key, string $default = null): ?string
    {
        return $this->data[$key] ?? $default;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function clearData(): void
    {
        $this->data = [];
    }
}
