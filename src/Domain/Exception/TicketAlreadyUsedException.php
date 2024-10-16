<?php

namespace App\Domain\Exception;

use Ticketing\Common\Domain\Exception\BusinessException;

class TicketAlreadyUsedException extends BusinessException
{
    public function __construct(string $code)
    {
        parent::__construct(sprintf('Ticket with code %s already used', $code), 'TicketAlreadyUsed');
    }
}
