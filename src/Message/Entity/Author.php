<?php

namespace App\Message\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
class Author
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\Column(type: 'integer')]
    private ?int $cityId = null;

    #[ORM\Column(type: 'integer')]
    private ?int $age = null;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    public function setCityId(?int $cityId): void
    {
        $this->cityId = $cityId;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): void
    {
        $this->age = $age;
    }
}
