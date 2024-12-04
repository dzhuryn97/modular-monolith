<?php

namespace App\Bill\EventListener;

use App\Bill\Service\BillService;
use App\User\IntegrationEvent\UserCreateIntegrationEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class UserCreatedEventListener
{
    public function __construct(
        private readonly BillService $billService,
    ) {
    }

    public function __invoke(UserCreateIntegrationEvent $event)
    {
        $this->billService->createAccount($event->userId);
    }
}
