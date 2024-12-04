<?php

namespace App\Message\EventListener;

use App\User\IntegrationEvent\UserCreateIntegrationEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class UserCreateListener
{
    public function __invoke(UserCreateIntegrationEvent $event)
    {
        // some logic
    }
}
