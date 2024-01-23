<?php

declare(strict_types=1);

namespace UtilityCore\Traits;

use Predis\Client;

trait RedisConnectionTrait
{
    protected $redis;

    public function initializeRedisConnection(string $host = null): void
    {
        // Configuración de la conexión a Redis
        // BD Nº 0 => PHP Sessions
        // BD Nº 1 => Workers
        // BD Nº 2 => Apps

        // Si nos llega $host, por ejemplo, en el caso de tener el proyecto
        // dockerizado ($host => 'redis_service')
        $redisConfig = [
            'scheme'   => 'tcp',
            'host'     => ($host == null) ? '127.0.0.1' : $host,
            'port'     => 6379,
            'database' => 2
        ];

        // Crea una instancia del cliente Predis
        $this->redis = new Client(
            $redisConfig,
            ['prefix' => 'jmarin_php_utility_core:']
        );
    }
}
