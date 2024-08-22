<?php

namespace App;

use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MyCustomProblemNormalizer implements NormalizerInterface
{

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        return [
            'meError' => 'hi'
        ];
//        dd('hello');
        // TODO: Implement normalize() method.
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {

        return $data instanceof FlattenException;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
//            FlattenException::class => true
        ];
    }
}