<?php

namespace App\Presenter;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\CheckIn\CheckInCommand;
use Ticketing\Common\Application\Command\CommandBusInterface;

class TicketCheckInProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    /**
     * @param TicketResource $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->commandBus->dispatch(new CheckInCommand(
            $data->eventId,
            $data->code,
        ));
    }
}
