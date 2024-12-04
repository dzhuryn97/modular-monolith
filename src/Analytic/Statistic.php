<?php

namespace App\Analytic;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Ramsey\Uuid\UuidInterface;

#[Entity]
class Statistic
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $userId;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(type: 'integer')]
    private int $messageCount = 0;

    public function __construct(UuidInterface $userId)
    {
        $this->userId = $userId;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    public function getMessageCount(): int
    {
        return $this->messageCount;
    }

    public function incrementMessageCount(): void
    {
        ++$this->messageCount;
    }

    public function getUserId(): UuidInterface
    {
        return $this->userId;
    }
}
