<?php

namespace App\Message;

use App\Message\Entity\Message;
use App\Shared\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Ramsey\Uuid\UuidInterface;

class MessageRepository
{
    private QueryBuilder $qb;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(
        EntityManagerInterface $em,
    ) {
        $this->repository = $em->getRepository(Message::class);
        $this->qb = $this->repository->createQueryBuilder('m');
    }

    public function findOrFail(UuidInterface $id): Message
    {
        $message = $this->repository->find($id);
        if (!$message) {
            throw new EntityNotFoundException($id, Message::class);
        }

        return $message;
    }

    public function withCity(int $cityId): MessageRepository
    {
        return $this->filter(static function (QueryBuilder $qb) use ($cityId) {
            self::joinAuthorOnce($qb);
            $qb->andWhere('a.cityId = :cityId')
                ->setParameter('cityId', $cityId);
        });
    }

    public function withAgeGraterThen(int $age): MessageRepository
    {
        return $this->filter(static function (QueryBuilder $qb) use ($age) {
            self::joinAuthorOnce($qb);
            $qb->andWhere('a.age > :ageGraterThen')
                ->setParameter('ageGraterThen', $age);
        });
    }

    public function withAgeLessThen(int $age): MessageRepository
    {
        return $this->filter(static function (QueryBuilder $qb) use ($age) {
            self::joinAuthorOnce($qb);
            $qb
                ->andWhere('a.age < :ageLessThen')
                ->setParameter('ageLessThen', $age);
        });
    }

    /**
     * @return Message[]
     */
    public function get(): array
    {
        return $this->qb->getQuery()->getResult();
    }

    private function filter(callable $filter): self
    {
        $cloned = clone $this;
        $filter($cloned->qb);

        return $cloned;
    }

    private static function joinAuthorOnce(QueryBuilder $qb)
    {
        if (!in_array('a', $qb->getAllAliases())) {
            $qb->join('m.author', 'a');
        }
    }
}
