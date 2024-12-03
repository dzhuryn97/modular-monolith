<?php

namespace App\Analytic;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AnalyticService
{
    private \Doctrine\DBAL\Connection $conn;

    public function __construct(
        EntityManagerInterface $em,
        private readonly DenormalizerInterface $denormalizer,
    ) {
        $this->conn = $em->getConnection();
    }

    public function getStatistic()
    {
        $sql = <<<SQL
            SELECT u.id as user_id, u.name as user_name, COUNT(m.id) AS message_count
            FROM "user" u
                     LEFT JOIN message m ON m.author_id = u.id
            GROUP BY u.id, u.name;
        SQL;

        $stmt = $this->conn->prepare($sql);
        $result = $stmt->executeQuery();

        $data = $result->fetchAllAssociative();

        return $this->denormalizer->denormalize($data, StatisticDTO::class.'[]');
    }
}
