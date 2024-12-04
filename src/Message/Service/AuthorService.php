<?php

namespace App\Message\Service;

use App\Message\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class AuthorService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function createAuthor(
        UuidInterface $id,
        ?int $age,
        ?int $cityId,
    ): Author {
        $author = new Author($id);
        $author->setAge($age);
        $author->setCityId($cityId);

        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }
}
