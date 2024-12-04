<?php

namespace App\Bill\Service;

use App\Bill\Entity\Account;
use App\Bill\Repository\AccountRepository;
use App\Shared\Exception\BusinessException;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class BillService
{
    public function __construct(
        private readonly AccountRepository $accountRepository,
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function createAccount(
        UuidInterface $accountId,
    ): Account {
        $account = new Account($accountId);
        $account->setMoneyAmount(10000);

        $this->em->persist($account);
        $this->em->flush();

        return $account;
    }

    public function chargeMoney(UuidInterface $accountId, int $amount): void
    {
        $account = $this->accountRepository->findOrFail($accountId);

        $moneyAmount = $account->getMoneyAmount();
        if ($moneyAmount < $amount) {
            throw new BusinessException(sprintf('Not enough money'));
        }

        $newMoneyAmount = $moneyAmount - $amount;
        $account->setMoneyAmount($newMoneyAmount);

        $this->em->flush();
    }

    public function doSomethingElse(): void
    {
    }
}
