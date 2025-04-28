<?php

declare(strict_types=1);

namespace CleanStructure\Core\Domain;

use ArrayObject;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

interface SerializerInterface
{
    /**
     * @param array<string, mixed> $context
     *
     * @return array<mixed>|string|int|float|bool|ArrayObject|null
     *
     * @throws InvalidArgumentException   Occurs when the object given is not a supported type for the normalizer
     * @throws CircularReferenceException Occurs when the normalizer detects a circular reference when no circular
     *                                    reference handler can fix it
     * @throws LogicException             Occurs when the normalizer is not called in an expected context
     * @throws ExceptionInterface         Occurs for all the other cases of errors
     */
    // @phpstan-ignore-next-line
    public function normalize(
        mixed $object,
        ?string $format = null,
        array $context = []
    ): array|string|int|float|bool|ArrayObject|null;

    /**
     * @template TObject
     *
     * @param class-string<TObject> $type
     * @param array<string, mixed> $context
     *
     * @return TObject
     *
     * @throws BadMethodCallException   Occurs when the normalizer is not called in an expected context
     * @throws InvalidArgumentException Occurs when the arguments are not coherent or not supported
     * @throws UnexpectedValueException Occurs when the item cannot be hydrated with the given data
     * @throws ExtraAttributesException Occurs when the item doesn't have attribute to receive given data
     * @throws LogicException           Occurs when the normalizer is not supposed to denormalize
     * @throws RuntimeException         Occurs if the class cannot be instantiated
     * @throws ExceptionInterface       Occurs for all the other cases of errors
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed;

    /**
     * Создание массива объектов
     *
     * @template TObject
     *
     * @param class-string<TObject> $type
     * @param array<string, mixed> $context
     *
     * @phpstan-return list<TObject>
     * @return list<TObject>
     */
    public function denormalizeArray(mixed $data, string $type, ?string $format = null, array $context = []): array;
}
