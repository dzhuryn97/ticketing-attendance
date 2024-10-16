<?php

namespace App\Presenter;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    shortName: 'Ticket',
    operations: [
        new Post(
            uriTemplate: 'tickets/check-in',
            denormalizationContext: [
                'groups' => [
                    'ticket:check-in',
                ],
            ],
            processor: TicketCheckInProcessor::class
        ),
    ]
)]
class TicketResource
{
    public function __construct(
        public ?UuidInterface $id = null,
        #[Groups(['ticket:check-in'])]
        public ?UuidInterface $eventId = null,
        #[Groups(['ticket:check-in'])]
        public ?string $code = null,
    ) {
    }
}
