<?php

namespace App\Presenter;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class StateProvider implements ProviderInterface
{


    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
            throw new \DomainException('Test 123');

        // TODO: Implement provide() method.
    }
}