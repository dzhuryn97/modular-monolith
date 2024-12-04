<?php

namespace App\User\EventListener;

use App\User\Event\UserCreatedEvent;
use App\User\IntegrationEvent\UserCreateIntegrationEvent;
use App\User\Repository\UserRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class UserCreatedListener
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(UserCreatedEvent $event): void
    {
        $user = $this->userRepository->findOrFail($event->userId);

        $this->eventDispatcher->dispatch(
            new UserCreateIntegrationEvent(
                userId: $event->userId,
                firstName: $user->getFirstName(),
                lastName: $user->getLastName(),
                email: $user->getEmail(),
                cityId: $user->getCityId(),
                age: $user->getAge()
            )
        );
    }
}
