<?php

namespace App\Bill\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Ramsey\Uuid\UuidInterface;

#[Entity]
#[ORM\Table(name: '`account`')]
class Account
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\Column]
    private int $moneyAmount = 0;

    public function __construct(
        UuidInterface $id,
    ) {
        $this->id = $id;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getMoneyAmount(): int
    {
        return $this->moneyAmount;
    }

    public function setMoneyAmount(int $moneyAmount): void
    {
        $this->moneyAmount = $moneyAmount;
    }
}
