<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration())
    ->addPathsToScan([
        __DIR__ . '/bootstrap',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/public',
        __DIR__ . '/routes',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ], isDev: false)
    ->ignoreErrorsOnPackage('open-telemetry/exporter-otlp', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('open-telemetry/opentelemetry-auto-laravel', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('open-telemetry/opentelemetry-logger-monolog', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('open-telemetry/sdk', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('open-telemetry/sem-conv', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('laravel/tinker', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('phpdocumentor/reflection-docblock', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('symfony/property-access', [ErrorType::UNUSED_DEPENDENCY]);
