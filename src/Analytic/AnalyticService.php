<?php

namespace App\Analytic;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class AnalyticService
{
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
        $this->repository = $em->getRepository(Statistic::class);
    }

    public function createStatistic(
        UuidInterface $userId,
        string $userName,
    ): Statistic {
        $statistic = new Statistic($userId);
        $statistic->setUserName($userName);

        $this->em->persist($statistic);
        $this->em->flush();

        return $statistic;
    }

    public function incrementStatistic(
        UuidInterface $userId,
    ): void {
        $statistic = $this->repository->find($userId);
        $statistic->incrementMessageCount();

        $this->em->flush();
    }

    /**
     * @return Statistic[]
     */
    public function getStatistic(): array
    {
        return $this->repository->findAll();
    }
}
