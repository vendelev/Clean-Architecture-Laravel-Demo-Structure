<?php

declare(strict_types=1);

namespace CleanStructure\Core\Domain;

interface TransactionInterface
{
    /**
     * Start a new database transaction
     */
    public function beginTransaction(): void;

    /**
     * Commit the active database transaction
     */
    public function commit(): void;

    /**
     * Rollback the active database transaction
     */
    public function rollBack(): void;
}
