<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Application\Command;

use CleanStructure\Core\Domain\SerializerInterface;
use CleanStructure\HealthCheck\Domain\Entity\HealthCheck;
use Illuminate\Database\ConnectionResolverInterface;

final readonly class CheckDbWriter
{
    public function __construct(
        private ConnectionResolverInterface $connection,
        private SerializerInterface $serializer
    ) {
    }

    public function createTable(): void
    {
        $this->connection->connection()->statement('CREATE TEMPORARY TABLE health_check(dummy_column VARCHAR(255));');
    }

    public function insertValue(HealthCheck $testValue): bool
    {
        /** @var array<mixed> $binds */
        $binds = $this->serializer->normalize($testValue);
        return $this->connection->connection()->insert('INSERT INTO health_check VALUES (:dummy_column)', $binds);
    }

    public function updateValue(string $newValue, string $oldValue): int
    {
        return $this->connection->connection()->update(
            'UPDATE health_check SET dummy_column = :newValue where dummy_column = :oldValue',
            [
                'newValue' => $newValue,
                'oldValue' => $oldValue,
            ]
        );
    }

    public function deleteValue(string $value): int
    {
        return $this->connection->connection()->delete(
            'DELETE FROM health_check WHERE dummy_column = :value',
            ['value' => $value]
        );
    }
}
