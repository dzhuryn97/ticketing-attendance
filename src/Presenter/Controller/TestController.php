<?php

namespace App\Presenter\Controller;

use App\Application\CheckIn\CheckInCommand;
use App\Application\CreateTicket\CreateTicketCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Ticketing\Common\Application\Command\CommandBusInterface;

class TestController extends AbstractController
{
    public function __construct(
        public readonly CommandBusInterface $commandBus
    )
    {
    }

    #[Route('/api/attendance/test')]
    public function index()
    {
//        return $this->json(true);
        throw new \DomainException('test');
        $this->commandBus->dispatch(
            new CheckInCommand(
                Uuid::fromString('8d28ee18-481f-4618-9ea2-ee5ba21d1968'),
                'tc_bfac126d-5293-406d-9755-b03541f71e64'
            )
        );

        return $this->json(true);
    }
}