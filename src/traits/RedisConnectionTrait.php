<?php

declare(strict_types=1);

namespace UtilityCore\Traits;

use Predis\Client;

trait RedisConnectionTrait
{
    protected $redis;

    public function initializeRedisConnection(
        string $host = null,
        int $port = null,
        int $database = null
    ): void {
        // Configuración de la conexión a Redis
        // BD Nº 0 => PHP Sessions
        // BD Nº 1 => Workers
        // BD Nº 2 => Apps

        // Si nos llega $host, por ejemplo, en el caso de tener el proyecto
        // dockerizado ($host => 'redis_service'), lo mismo con el puerto y BD
        $redisConfig = [
            'scheme'   => 'tcp',
            'host'     => (is_null($host)) ? '127.0.0.1' : $host,
            'port'     => (is_null($port)) ? 6379 : $port,
            'database' => (is_null($database)) ? 2 : $database
        ];

        // Crea una instancia del cliente Predis
        $this->redis = new Client(
            $redisConfig,
            ['prefix' => 'jmarin_php_utility_core:']
        );
    }
}
