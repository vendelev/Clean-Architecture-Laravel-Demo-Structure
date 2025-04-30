<?php

declare(strict_types=1);

namespace Tests\Architecture;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final readonly class CleanStructureTest
{
    public function testApplicationFolder(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Command[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Factory[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Responder[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Service[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Query[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\UseCase[\\\]*\.*/', true),
            )
            ->shouldBeNamed('/.+Application.+/', true)
            ->because('Этот класс должен находится в слое Application');
    }

    public function testIsFinal(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Application[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Infrastructure[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Presentation[\\\]*\.*/', true),
            )
            ->shouldBeFinal()
            ->because('Класс должен быть Final');
    }

    public function testIsReadonly(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Application[\\\]*\.*/', true),
            )
            ->shouldBeReadonly()
            ->because('Класс должен быть Readonly');
    }

    public function testDomainFolder(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Event[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Exception[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Entity[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Request[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Response[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Validation[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\ValueObject[\\\]*\.*/', true),
            )
            ->shouldBeNamed('/.+Domain.+/', true)
            ->because('Этот класс должен находится в слое Domain');
    }

    public function testInterfaceInDomain(): Rule
    {
        return Phpat::rule()
            ->classes(Selector::isInterface())
            ->shouldBeNamed('/.+Domain.+/', true)
            ->because('Все Interface должны находится в слое Domain');
    }

    public function testPresentationFolder(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Config[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Console[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Http[\\\]*\.*/', true),
                Selector::inNamespace('/^CleanStructure.*\\\\Listener[\\\]*\.*/', true),
            )
            ->shouldBeNamed('/.+Presentation.+/', true)
            ->because('Этот класс должен находится в слое Presentation');
    }

    public function testInfrastructureFolder(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('/^CleanStructure.*\\\\Adapter[\\\]*\.*/', true),
            )
            ->shouldBeNamed('/.+Infrastructure.+/', true)
            ->because('Этот класс должен находится в слое Infrastructure');
    }
}
