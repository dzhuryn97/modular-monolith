<?php

namespace App\User\Client;

use App\User\Repository\UserRepository;
use App\User\Service\UserService;
use Ramsey\Uuid\UuidInterface;

class Client implements ClientInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private readonly UserService $userService,
    ) {
    }

    public function getUser(UuidInterface $userId): UserDTO
    {
        $user = $this->userRepository->findOrFail($userId);

        return $this->transformToUserDTO($user);
    }

    public function updateMoneyAmount(UuidInterface $userId, int $amount): void
    {
        $this->userService->updateMoneyAmount($userId, $amount);
    }

    private function transformToUserDTO(\App\User\Entity\User $user): UserDTO
    {
        $dto = new UserDTO()
        ;
        $dto->id = $user->getId();
        $dto->name = $user->getFirstName().' '.$user->getLastName();
        $dto->moneyAmount = $user->getMoneyAmount();

        return $dto;
    }
}
