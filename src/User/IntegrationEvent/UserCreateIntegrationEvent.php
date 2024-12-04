<?php

namespace App\User\IntegrationEvent;

use Ramsey\Uuid\UuidInterface;

class UserCreateIntegrationEvent
{
    public function __construct(
        public readonly UuidInterface $userId,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly int $cityId,
        public readonly int $age,
    ) {
    }
}
