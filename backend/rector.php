<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPublicMethodParameterRector;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\Php84\Rector\MethodCall\NewMethodCallWithoutParenthesesRector;
use Rector\Privatization\Rector\Class_\FinalizeTestCaseClassRector;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;
use Rector\ValueObject\PhpVersion;
use Rector\Visibility\Rector\ClassConst\ChangeConstantVisibilityRector;
use Rector\Visibility\Rector\ClassMethod\ExplicitPublicClassMethodRector;
use RectorLaravel\Rector\Class_\AddExtendsAnnotationToModelFactoriesRector;
use RectorLaravel\Rector\FuncCall\ArgumentFuncCallToMethodCallRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereRelationTypeHintingParameterRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereTypeHintClosureParameterRector;
use RectorLaravel\Rector\MethodCall\ResponseHelperCallToJsonResponseRector;
use RectorLaravel\Set\LaravelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/bootstrap',
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/routes',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        __DIR__ . '/bootstrap/cache',
    ])
    ->withParallel()
    ->withCache(__DIR__ . '/storage/rector')
    ->withPhpSets()
    ->withPhpVersion(PhpVersion::PHP_84)
    ->withAttributesSets()
    ->withComposerBased(phpunit: true)
    ->withSets([
        SetList::DEAD_CODE,
        SetList::PRIVATIZATION,
        LaravelSetList::LARAVEL_STATIC_TO_INJECTION,
        LaravelSetList::LARAVEL_120,
    ])
    ->withRules([
        DeclareStrictTypesRector::class,
        ChangeConstantVisibilityRector::class,
        ExplicitPublicClassMethodRector::class,
        FinalizeTestCaseClassRector::class,
        AddExtendsAnnotationToModelFactoriesRector::class,
        ArgumentFuncCallToMethodCallRector::class,
        EloquentWhereRelationTypeHintingParameterRector::class,
        EloquentWhereTypeHintClosureParameterRector::class,
        ResponseHelperCallToJsonResponseRector::class,

    ])
    ->withSkip([
        AddOverrideAttributeToOverriddenMethodsRector::class,
        RemoveUnusedPublicMethodParameterRector::class,
        NewMethodCallWithoutParenthesesRector::class, //конфликтует с phpmd
    ]);
