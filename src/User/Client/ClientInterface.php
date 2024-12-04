<?php

namespace App\User\Client;

use Ramsey\Uuid\UuidInterface;

interface ClientInterface
{
    public function getUser(UuidInterface $userId): UserDTO;
}
