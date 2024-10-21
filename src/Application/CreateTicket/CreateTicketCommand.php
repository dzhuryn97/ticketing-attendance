<?php

namespace App\Application\CreateTicket;

use Ramsey\Uuid\UuidInterface;
use Ticketing\Common\Application\Command\CommandInterface;

class CreateTicketCommand implements CommandInterface
{
    public function __construct(
        public readonly UuidInterface $ticketId,
        public readonly UuidInterface $eventId,
        public readonly  string $code,
    ) {
    }
}
