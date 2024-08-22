<?php

namespace App\Domain;

use Ramsey\Uuid\UuidInterface;
use Ticketing\Common\Domain\DomainEvent;

class TicketCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        public readonly UuidInterface $ticketId
    )
    {
        parent::__construct();
    }
}