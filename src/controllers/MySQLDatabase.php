<?php

declare(strict_types=1);

namespace UtilityCore\Controllers;

use PDO;
use PDOException;
use Exception;
use UtilityCore\Interfaces\DatabaseInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class MySQLDatabase implements DatabaseInterface
{
    private $pdo;
    private $dbhost;
    private $dbport;
    private $dbname;
    private $dbuser;
    private $dbpass;

    public function __construct(object $dotenv)
    {
        $this->dbhost = $dotenv->get('DB_HOST');
        $this->dbport = $dotenv->get('DB_PORT');
        $this->dbname = $dotenv->get('DB_DATABASE');
        $this->dbuser = $dotenv->get('DB_USERNAME');
        $this->dbpass = $dotenv->get('DB_PASSWORD');
    }

    public function connectORM(): void
    {
        try {
            $capsule = new Capsule();
            $capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $this->dbhost,
                'port'      => $this->dbport,
                'database'  => $this->dbname,
                'username'  => $this->dbuser,
                'password'  => $this->dbpass,
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        } catch (Exception $e) {
            echo "Database connection error: " . $e->getMessage();
        }
    }

    public function connect(): void
    {
        try {
            $dsn = "mysql:host={$this->dbhost};"
                   . "port={$this->dbport};"
                   . "dbname={$this->dbname};"
                   . "charset=utf8mb4";

            $this->pdo = new PDO($dsn, $this->dbuser, $this->dbpass);
            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            exit("Connection error: {$e->getMessage()}");
        }
    }

    public function disconnect(): void
    {
        $this->pdo = null;
    }

    public function getPDO(): object
    {
        return $this->pdo;
    }

    public function getDbName(): string
    {
        return $this->dbname;
    }

    public function transaction(string $sql, array $params = []): void
    {
        $this->prepareAndExecute($sql, $params);
    }

    public function getArrayAssoc(
        string $sql,
        string $method = 'fetch',
        array $params = []
    ): array {
        $stmt = $this->prepareAndExecute($sql, $params);

        if ($method == 'fetch') {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return (!$result) ? [] : $result;
    }

    private function prepareAndExecute(string $sql, array $params = []): object
    {
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();

        return $stmt;
    }
}
