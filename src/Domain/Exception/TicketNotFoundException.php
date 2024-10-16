<?php

namespace App\Domain\Exception;

use App\Domain\Ticket\Ticket;
use Ticketing\Common\Domain\Exception\EntityNotFoundException;

class TicketNotFoundException extends EntityNotFoundException
{
    public function __construct(string $code)
    {
        parent::__construct($code, Ticket::class);
    }
}
