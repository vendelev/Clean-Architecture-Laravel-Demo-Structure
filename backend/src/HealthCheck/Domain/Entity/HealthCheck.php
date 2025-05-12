<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Domain\Entity;

use Symfony\Component\Serializer\Attribute\SerializedName;

final readonly class HealthCheck
{
    public function __construct(
        #[SerializedName('dummy_column')]
        public string $dummyColumn,
    ) {
    }
}
