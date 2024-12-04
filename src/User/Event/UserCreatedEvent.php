<?php

namespace App\User\Event;

use Ramsey\Uuid\UuidInterface;

class UserCreatedEvent
{
    public function __construct(
        public readonly UuidInterface $userId,
    ) {
    }
}
