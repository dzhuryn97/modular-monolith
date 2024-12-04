<?php

namespace App\Message\Event;

use Ramsey\Uuid\UuidInterface;

class MessageCreatedEvent
{
    public function __construct(
        public readonly UuidInterface $messageId,
    ) {
    }
}
