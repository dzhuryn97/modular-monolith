<?php

namespace App\Message\IntegrationEvent;

use Ramsey\Uuid\UuidInterface;

class MessageCreatedIntegrationEvent
{
    public function __construct(
        public readonly UuidInterface $messageId,
        public readonly UuidInterface $authorId,
        public readonly string $messageText,
    ) {
    }
}
