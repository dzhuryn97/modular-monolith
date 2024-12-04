<?php

namespace App\Message\EventListener;

use App\Message\Service\AuthorService;
use App\User\IntegrationEvent\UserCreateIntegrationEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class UserCreateListener
{
    public function __construct(
        private readonly AuthorService $authorService,
    ) {
    }

    public function __invoke(UserCreateIntegrationEvent $event)
    {
        $this->authorService->createAuthor(
            id: $event->userId,
            age: $event->age,
            cityId: $event->cityId
        );
    }
}
