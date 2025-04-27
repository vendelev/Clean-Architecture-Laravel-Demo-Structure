<?php

declare(strict_types=1);

namespace CleanStructure\Core\Infrastructure\Illuminate;

use CleanStructure\Core\Domain\TransactionInterface;
use Illuminate\Database\ConnectionResolverInterface;

final readonly class PostgresTransaction implements TransactionInterface
{
    public function __construct(
        private ConnectionResolverInterface $connection,
    ) {
    }

    public function beginTransaction(): void
    {
        $this->connection->connection()->beginTransaction();
    }

    public function commit(): void
    {
        $this->connection->connection()->commit();
    }

    public function rollBack(): void
    {
        $this->connection->connection()->rollBack();
    }
}
