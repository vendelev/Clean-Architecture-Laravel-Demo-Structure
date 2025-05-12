<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Application\Query;

use CleanStructure\Core\Domain\SerializerInterface;
use CleanStructure\HealthCheck\Domain\Entity\HealthCheck;
use Illuminate\Database\ConnectionResolverInterface;

final readonly class CheckDbReader
{
    public function __construct(
        private ConnectionResolverInterface $connection,
        private SerializerInterface $serializer
    ) {
    }

    /**
     * Получить все записи
     *
     * @return list<\CleanStructure\HealthCheck\Domain\Entity\HealthCheck>
     */
    public function selectAllValues(): array
    {
        $data = $this->connection->connection()->select('SELECT dummy_column FROM health_check');

        return $this->serializer->denormalizeArray($data, HealthCheck::class, 'array');
    }
}
