<?php

namespace App\Bill\Client;

use Ramsey\Uuid\UuidInterface;

interface ClientInterface
{
    public function chargeMoney(UuidInterface $userId, int $amount): void;
}
