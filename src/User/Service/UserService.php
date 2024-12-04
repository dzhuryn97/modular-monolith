<?php

namespace App\User\Service;

use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function createUser(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        ?int $cityId = null,
        ?int $age = null,
    ): User {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
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

    public function updateMoneyAmount(
        UuidInterface $userId,
        int $amount,
    ) {
        $user = $this->userRepository->findOrFail($userId);
        $user->setMoneyAmount($amount);

        $this->em->flush();
    }
}
