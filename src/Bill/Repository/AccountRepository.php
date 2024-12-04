<?php

namespace App\Bill\Repository;

use App\Bill\Entity\Account;
use App\Shared\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class AccountRepository
{
    private \Doctrine\ORM\QueryBuilder $qb;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
        $this->repository = $em->getRepository(Account::class);
        $this->qb = $em->createQueryBuilder('q');
    }

    public function findOrFail(UuidInterface $id): Account
    {
        $account = $this->repository->find($id);
        if (!$account) {
            throw new EntityNotFoundException($id, Account::class);
        }

        return $account;
    }
}
