<?php

declare(strict_types=1);

namespace CleanStructure\Core\Presentation\Config;

use CleanStructure\Core\Domain\SerializerInterface;
use CleanStructure\Core\Domain\TransactionInterface;
use CleanStructure\Core\Infrastructure\Illuminate\PostgresTransaction;
use CleanStructure\Core\Infrastructure\Symfony\SerializerDecorator;
use Illuminate\Support\ServiceProvider;

final class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SerializerInterface::class, static fn() => SerializerDecorator::create());
        $this->app->bind(TransactionInterface::class, PostgresTransaction::class);
    }
}
