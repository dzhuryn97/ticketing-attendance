<?php

namespace App\Domain;

use Ramsey\Uuid\UuidInterface;

interface TicketRepositoryInterface
{
    public function findById(UuidInterface $ticketId): ?Ticket;

    public function findForCheckIn(string $code, UuidInterface $eventId): ?Ticket;

    public function add(Ticket $ticket): void;

    public function save(Ticket $ticket): void;
}
