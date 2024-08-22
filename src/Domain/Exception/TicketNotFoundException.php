<?php

namespace App\Domain\Exception;

use Ticketing\Common\Domain\DomainEvent;

class TicketNotFoundException extends \DomainException
{
    public function __construct(string $code)
    {
        parent::__construct(sprintf('Ticket with code %s not foun2d', $code));
    }
}