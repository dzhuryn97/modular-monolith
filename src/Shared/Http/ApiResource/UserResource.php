<?php

namespace App\Shared\Http\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Shared\Http\Processor\CreateUserResourceProcessor;
use App\Shared\Http\Provider\UserResourceProvider;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    shortName: 'User',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            processor: CreateUserResourceProcessor::class
        ),
    ],
    normalizationContext: [
        'groups' => [
            'user:read',
        ],
    ],
    denormalizationContext: [
        'groups' => [
            'user:write',
        ],
    ],
    paginationEnabled: false,
    provider: UserResourceProvider::class
)]
class UserResource
{
    #[ApiProperty(identifier: true)]
    #[Groups(['user:read'])]
    public ?UuidInterface $id = null;

    #[ApiProperty]
    #[Groups(['user:read', 'user:write'])]
    public ?string $firstName = null;

    #[ApiProperty]
    #[Groups(['user:read', 'user:write'])]
    public ?string $lastName = null;

    #[ApiProperty]
    #[Groups(['user:read', 'user:write'])]
    public ?string $email = null;

    #[ApiProperty]
    #[Groups(['user:write'])]
    public ?string $password = null;

    #[ApiProperty]
    #[Groups(['user:read', 'user:write'])]
    public ?int $age = null;
    #[ApiProperty]
    #[Groups(['user:read', 'user:write'])]
    public ?int $cityId = null;

    public static function fromUser(\App\User\Entity\User $user): self
    {
        $userResource = new self();
        $userResource->id = $user->getId();
        $userResource->firstName = $user->getFirstName();
        $userResource->lastName = $user->getFirstName();
        $userResource->email = $user->getEmail();
        $userResource->cityId = $user->getCityId();
        $userResource->age = $user->getAge();

        return $userResource;
    }
}
