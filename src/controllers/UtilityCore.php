<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use Exception;
use UtilityCore\Interfaces\UtilityCoreInterface;

class UtilityCore implements UtilityCoreInterface
{
    private $container;
    private $dotenv;
    private $mysql;

    public function __construct(string $env = null)
    {
        $pathEnv = '/var/www/html/.environment/.env_production';

        if (isset($env)) {
            $pathEnv = $env;
        }

        $this->container = new Container();

        $this->container->clearBindings();

        $this->container->bind(
            'UtilityCore\Interfaces\DotEnvInterface',
            function ($container) {
                return function ($pathEnv) use ($container) {
                    $dotEnv = new DotEnvironment($pathEnv);
                    $dotEnv->load();
                    return $dotEnv;
                };
            }
        );

        $dotEnvResolver =
        $this->container->resolve('UtilityCore\Interfaces\DotEnvInterface');
        $this->dotenv   = $dotEnvResolver($pathEnv);

        $this->container->bind(
            'UtilityCore\Interfaces\DatabaseInterface',
            function ($container) {
                return function ($dotEnv) use ($container) {
                    return new MySQLDatabase($dotEnv);
                };
            }
        );

        $mysqlResolver =
        $this->container->resolve('UtilityCore\Interfaces\DatabaseInterface');
        $this->mysql   = $mysqlResolver($this->dotenv);
    }

    public function getContainer(): object
    {
        return $this->container->getContainer();
    }

    public function getDotEnv(): object
    {
        return $this->dotenv;
    }

    public function getDb(): object
    {
        return $this->mysql;
    }

    public function getUtil(int $util, ...$args): void
    {
        switch ($util) {
            // Manejar respuestas del servidor
            case 1:
                if (count($args) === 1) {
                    $cod = $args[0];
                    $msg = null;
                } elseif (count($args) === 2) {
                    $cod = $args[0];
                    $msg = $args[1];
                } else {
                    throw new Exception(
                        'The function must receive one or two arguments'
                    );
                }

                $this->container->bind(
                    'UtilityCore\Interfaces\ServerResponseInterface',
                    'UtilityCore\Libraries\ServerResponse'
                );

                $response = $this->container->resolve(
                    'UtilityCore\Interfaces\ServerResponseInterface'
                );

                $response->getResponse($cod, $msg);

                break;

            // Añadir aquí tantos `case` como utilidades se quieran elaborar

            // Si se proporciona una utilidad no definida previamente devuelve
            // respuesta de Acceso prohibido (403)
            default:
                ServerResponse::respondForbidden('Acceso prohibido');
                break;
        }
    }
}
