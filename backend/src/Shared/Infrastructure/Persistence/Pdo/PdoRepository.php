<?php

namespace Burger\Shared\Infrastructure\Persistence\Pdo;

use PDO;

class PdoRepository
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
