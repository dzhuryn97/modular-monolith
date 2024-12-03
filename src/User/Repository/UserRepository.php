<?php

namespace App\User\Repository;

use App\Shared\Exception\EntityNotFoundException;
use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class UserRepository
{
    private \Doctrine\ORM\QueryBuilder $qb;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
        $this->repository = $em->getRepository(User::class);
        $this->qb = $em->createQueryBuilder('q');
    }

    public function findOrFail(UuidInterface $id): User
    {
        $user = $this->repository->find($id);
        if (!$user) {
            throw new EntityNotFoundException($id, User::class);
        }

        return $user;
    }

    /**
     * @return User[]
     */
    public function get(): array
    {
        return $this->repository->findAll();
    }
}
