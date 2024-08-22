<?php

namespace App\Domain;

use App\Domain\Exception\TicketAlreadyUsedException;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ticketing\Common\Domain\DomainEntity;

#[ORM\Entity(
    repositoryClass: TicketRepositoryInterface::class
)]
class Ticket extends DomainEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\Column(type: 'uuid')]
    private UuidInterface $eventId;

    #[ORM\Column]
    private string $code;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $usedAt;

    public function __construct(
        UuidInterface $id,
        UuidInterface $eventId,
        string $code,
    )
    {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->code = $code;

        $this->raiseDomainEvent(new TicketCreatedDomainEvent($this->id));
    }

    public function checkIn(): void
    {
        if($this->usedAt){
            throw new TicketAlreadyUsedException($this->code);
        }
        $this->usedAt = new \DateTimeImmutable();
        $this->raiseDomainEvent(new TicketUsedDomainEvent($this->id));
    }
}