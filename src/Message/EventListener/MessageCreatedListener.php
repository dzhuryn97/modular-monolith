<?php

namespace App\Message\EventListener;

use App\Message\Event\MessageCreatedEvent;
use App\Message\IntegrationEvent\MessageCreatedIntegrationEvent;
use App\Message\MessageRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class MessageCreatedListener
{
    public function __construct(
        private readonly MessageRepository $messageRepository,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(MessageCreatedEvent $event): void
    {
        $message = $this->messageRepository->findOrFail($event->messageId);

        $this->eventDispatcher->dispatch(new MessageCreatedIntegrationEvent(
            messageId: $message->getId(),
            authorId: $message->getAuthor()->getId(),
            messageText: $message->getMessageText()
        ));
    }
}
