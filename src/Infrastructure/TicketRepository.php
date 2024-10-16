<?php

namespace App\Infrastructure;

use App\Domain\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

class TicketRepository extends ServiceEntityRepository implements \App\Domain\TicketRepositoryInterface
{
    private \Doctrine\ORM\EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
        $this->em = $this->getEntityManager();
    }

    public function findById(UuidInterface $ticketId): ?Ticket
    {
        return $this->find($ticketId);
    }

    public function findForCheckIn(string $code, UuidInterface $eventId): ?Ticket
    {
        return $this->findOneBy(['code' => $code, 'eventId' => $eventId]);
    }

    public function add(Ticket $ticket): void
    {
        $this->em->persist($ticket);
        $this->em->flush();
    }

    public function save(Ticket $ticket): void
    {
        $this->em->flush();
    }
}
