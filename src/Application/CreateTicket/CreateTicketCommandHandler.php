<?php

namespace App\Application\CreateTicket;

use App\Domain\Ticket;
use App\Domain\TicketRepositoryInterface;
use Ticketing\Common\Application\Command\CommandHandlerInterface;
use Ticketing\Common\Application\FlusherInterface;

class CreateTicketCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly TicketRepositoryInterface $ticketRepository,
        private readonly FlusherInterface $flusher
    )
    {
    }

    public function __invoke(CreateTicketCommand $command)
    {
        $ticket = new Ticket(
            $command->ticketId,
            $command->eventId,
            $command->code
        );

        $this->ticketRepository->add($ticket);
        $this->flusher->flush();
    }
}