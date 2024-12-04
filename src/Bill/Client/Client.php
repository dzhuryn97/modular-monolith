<?php

namespace App\Bill\Client;

use App\Bill\Service\BillService;
use Ramsey\Uuid\UuidInterface;

class Client implements ClientInterface
{
    public function __construct(
        private readonly BillService $billService,
    ) {
    }

    public function chargeMoney(UuidInterface $userId, int $amount): void
    {
        $this->billService->chargeMoney($userId, $amount);
    }
}
