<?php

namespace App\Shared\Http\Provider;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Shared\Http\ApiResource\UserResource;
use App\User\Entity\User;
use App\User\Repository\UserRepository;

class UserResourceProvider implements ProviderInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof GetCollection) {
            return $this->provideCollection();
        }

        $user = $this->userRepository->findOrFail($uriVariables['id']);

        return UserResource::fromUser($user);
    }

    private function provideCollection()
    {
        return array_map(function (User $user) {
            return UserResource::fromUser($user);
        }, $this->userRepository->get());
    }
}
