<?php

namespace App\Presenter;

use App\Application\CreateTicket\CreateTicketCommand;
use Ticketing\Common\Application\Command\CommandBusInterface;
use Ticketing\Common\Application\EventBus\IntegrationEventHandlerInterface;
use Ticketing\Common\IntegrationEvent\Ticket\TicketIssuedIntegrationEvent;

class TicketIssuedIntegrationEventHandler implements IntegrationEventHandlerInterface
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(TicketIssuedIntegrationEvent $event)
    {
        $this->commandBus->dispatch(new CreateTicketCommand(
            $event->ticketId,
            $event->eventId,
            $event->code,
        ));
    }
}
