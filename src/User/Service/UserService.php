<?php

namespace App\User\Service;

use App\User\Entity\User;
use App\User\Event\UserCreatedEvent;
use App\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EventDispatcherInterface $eventDispatcher,
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

        $this->eventDispatcher->dispatch(new UserCreatedEvent($user->getId()));

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
