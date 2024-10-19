<?php

namespace App\Application\CheckIn;

use Ramsey\Uuid\UuidInterface;
use Ticketing\Common\Application\Command\CommandInterface;

class CheckInCommand implements CommandInterface
{
    public function __construct(
        public readonly UuidInterface $eventId,
        public readonly string $code,
    ) {
    }
}
