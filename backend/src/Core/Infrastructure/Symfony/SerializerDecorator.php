<?php

declare(strict_types=1);

namespace CleanStructure\Core\Infrastructure\Symfony;

use CleanStructure\Core\Domain\SerializerInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/** @SuppressWarnings(CouplingBetweenObjects) */
final class SerializerDecorator extends Serializer implements SerializerInterface
{
    public static function create(): SerializerInterface
    {
        $phpDocExtractor = new PhpDocExtractor();
        $reflectionExtractor = new ReflectionExtractor();

        $listExtractors = [$reflectionExtractor];
        $typeExtractors = [$phpDocExtractor, $reflectionExtractor];
        $docExtractors = [$phpDocExtractor];
        $accessExtractors = [$reflectionExtractor];
        $propertyExtractors = [$reflectionExtractor];

        $propertyInfo = new PropertyInfoExtractor(
            $listExtractors,
            $typeExtractors,
            $docExtractors,
            $accessExtractors,
            $propertyExtractors
        );

        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $nameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        return new self(
            [
                new DateTimeZoneNormalizer(),
                new DateTimeNormalizer(),
                new BackedEnumNormalizer(),
                new ArrayDenormalizer(),
                new ObjectNormalizer($classMetadataFactory, $nameConverter, null, $propertyInfo),
            ],
            [new JsonEncoder()]
        );
    }

    /**
     * @inheritDoc
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        return parent::denormalize(
            $data,
            $type,
            $format,
            $context + [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true]
        );
    }

    /**
     * @inheritDoc
     * @param array<string, mixed> $context
     */
    public function denormalizeArray(mixed $data, string $type, ?string $format = null, array $context = []): array
    {
        return parent::denormalize(
            $data,
            $type . '[]',
            $format,
            $context + [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true]
        );
    }
}
