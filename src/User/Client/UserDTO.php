<?php

namespace App\User\Client;

use Ramsey\Uuid\UuidInterface;

class UserDTO
{
    public UuidInterface $id;

    public string $name;
}
