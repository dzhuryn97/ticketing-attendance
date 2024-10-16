<?php

namespace App\Application\CheckIn;

use App\Domain\Exception\TicketNotFoundException;
use App\Domain\TicketRepositoryInterface;
use Ticketing\Common\Application\Command\CommandHandlerInterface;

class CheckInCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly TicketRepositoryInterface $ticketRepository,
    ) {
    }

    public function __invoke(CheckInCommand $command)
    {
        $ticket = $this->ticketRepository->findForCheckIn($command->code, $command->eventId);
        if (!$ticket) {
            throw new TicketNotFoundException($command->code);
        }

        $ticket->checkIn();

        $this->ticketRepository->save($ticket);
    }
}
