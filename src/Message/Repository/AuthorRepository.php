<?php

namespace App\Message\Repository;

use App\Message\Entity\Author;
use App\Shared\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class AuthorRepository
{
    private \Doctrine\ORM\QueryBuilder $qb;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
        $this->repository = $em->getRepository(Author::class);
        $this->qb = $em->createQueryBuilder('q');
    }

    public function findOrFail(UuidInterface $id): Author
    {
        $author = $this->repository->find($id);
        if (!$author) {
            throw new EntityNotFoundException($id, Author::class);
        }

        return $author;
    }
}
