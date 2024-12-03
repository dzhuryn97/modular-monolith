<?php

namespace App\User\Service;

use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function createUser(
        string $name,
        string $email,
        string $password,
        ?int $cityId = null,
        ?int $age = null,
    ): User {
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setCityId($cityId);
        $user->setAge($age);
        $user->setMoneyAmount(10000);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
