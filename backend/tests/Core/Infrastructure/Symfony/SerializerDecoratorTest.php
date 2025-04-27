<?php

declare(strict_types=1);

namespace Tests\Core\Infrastructure\Symfony;

use CleanStructure\Core\Domain\SerializerInterface;
use CleanStructure\Core\Infrastructure\Symfony\SerializerDecorator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Tests\TestCase;

class SerializerDecoratorTest extends TestCase
{
    /**
     * Проверим правильность подключения в ServiceProvider
     *
     * @throws BindingResolutionException
     */
    public function testProvider(): void
    {
        self::assertInstanceOf(SerializerInterface::class, $this->service(SerializerInterface::class));
    }

    /**
     * Проверим преобразование ассоциативного массива в объект
     *
     * @throws ExceptionInterface
     */
    public function testNormalization(): void
    {
        $serializer = SerializerDecorator::create();
        $data = ['test' => '123'];

        $class = new class () {
            public int $test;
        };

        $result = $serializer->normalize($serializer->denormalize($data, $class::class));
        self::assertSame(['test' => 123], $result);
    }

    /**
     * Проверим преобразование двумерного массива в массив объектов
     *
     * @throws ExceptionInterface
     */
    public function testNormalizationArray(): void
    {
        $serializer = SerializerDecorator::create();
        $data = [['test' => '123'], ['test' => '456']];

        $class = new class () {
            public int $test;
        };

        $result = $serializer->normalize($serializer->denormalizeArray($data, $class::class, 'array'));
        self::assertSame([['test' => 123], ['test' => 456]], $result);
    }
}
