<?php

declare(strict_types=1);

namespace UtilityCore\Interfaces;

interface DatabaseInterface
{
    public function connectORM(): void;
    public function connect(): void;
    public function disconnect(): void;
    public function getPDO(): object;
    public function getDbName(): string;
    public function transaction(string $sql, array $params = []): void;
    public function getArrayAssoc(
        string $sql,
        string $method = 'fetch',
        array $params = []
    ): array;
}
