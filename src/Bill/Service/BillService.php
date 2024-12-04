<?php

namespace App\Bill\Service;

use App\Shared\Exception\BusinessException;
use App\User\Client\ClientInterface as UserClient;
use Ramsey\Uuid\UuidInterface;

class BillService
{
    public function __construct(
        private readonly UserClient $userClient,
    ) {
    }

    public function chargeMoney(UuidInterface $userId, int $amount): void
    {
        $user = $this->userClient->getUser($userId);

        $moneyAmount = $user->moneyAmount;
        if ($moneyAmount < $amount) {
            throw new BusinessException(sprintf('Not enough money'));
        }

        $newMoneyAmount = $moneyAmount - $amount;
        $this->userClient->updateMoneyAmount($userId, $newMoneyAmount);
    }

    public function doSomethingElse(): void
    {
    }
}
