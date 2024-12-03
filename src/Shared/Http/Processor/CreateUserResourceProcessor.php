<?php

namespace App\Shared\Http\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Shared\Http\ApiResource\UserResource;
use App\User\Service\UserService;

class CreateUserResourceProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly UserService $userService,
    ) {
    }

    /**
     * @param UserResource $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $user = $this->userService->createUser(
            name: $data->name,
            email: $data->email,
            password: $data->password,
            cityId: $data->cityId,
            age: $data->age,
        );

        return UserResource::fromUser($user);
    }
}
