<?php

namespace App;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onException'
        ];
        // TODO: Implement getSubscribedEvents() method.
    }

    public function onException(ExceptionEvent $exception)
    {
//        dd($exception);
    }
}