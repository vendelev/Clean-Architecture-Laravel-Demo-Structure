<?php

declare(strict_types=1);

namespace Tests\Architecture;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final readonly class CleanArchitectureTest
{
    public function testDomainLayer(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^CleanStructure.*\\\\Domain\\\\.*/', true))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Application\\\\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Presentation\\\\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Infrastructure\\\\.*/', true),
            )
            ->because('Domain может использовать только Domain (и свой и чужой)');
    }

    public function testApplicationLayer(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^CleanStructure.*\\\\Application\\\\.*/', true))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Presentation\\\\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Infrastructure\\\\.*/', true),
            )
            ->because('Application может использовать Domain (только свой)');
    }

    public function testInfrastructureLayer(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('/^CleanStructure.*\\\\Infrastructure\\\\.*/', true))
            ->shouldNotDependOn()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Presentation\\\\.*/', true),
            )
            ->because('Infrastructure может использовать только Application и Domain (и свой и чужой)');
    }
}
