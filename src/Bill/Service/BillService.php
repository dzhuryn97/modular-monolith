<?php

namespace App\Bill\Service;

use App\Shared\Exception\BusinessException;
use App\User\Repository\UserRepository;
use Ramsey\Uuid\UuidInterface;

class BillService
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function chargeMoney(UuidInterface $userId, int $amount): void
    {
        $user = $this->userRepository->findOrFail($userId);

        $moneyAmount = $user->getMoneyAmount();
        if ($moneyAmount < $amount) {
            throw new BusinessException(sprintf('Not enough money'));
        }

        $newMoneyAmount = $moneyAmount - $amount;
        $user->setMoneyAmount($newMoneyAmount);
    }
}
