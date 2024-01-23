<?php

declare(strict_types=1);

namespace UtilityCore\Traits;

use UtilityCore\Controllers\UtilityCore;

trait DbConnectionTrait
{
    protected $db;

    public function initializeDbConnection(string $pathEnv = null): void
    {
        $utils    = new UtilityCore($pathEnv);
        $this->db = $utils->getDb();

        $this->db->connectORM();
    }
}
