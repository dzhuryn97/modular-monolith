<?php

namespace App\Shared\Http\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\QueryParameter;
use App\Shared\Http\Processor\CreateMessageProcessor;
use App\Shared\Http\Provider\MessageResourceProvider;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    shortName: 'message',
    operations: [
        new Get(),
        new GetCollection(
            parameters: [
                new QueryParameter(key: 'age[min]'),
                new QueryParameter(key: 'age[max]'),
                new QueryParameter(key: 'city_id'),
            ]
        ),
        new Post(
            processor: CreateMessageProcessor::class,
        ),
    ],
    paginationEnabled: false,
    provider: MessageResourceProvider::class,
    normalizationContext: [
        'groups' => ['message:read'],
    ],
    denormalizationContext: [
        'groups' => ['message:write'],
    ]
)]
class MessageResource
{
    #[ApiProperty]
    #[Groups(['message:read'])]
    public ?UuidInterface $id = null;

    #[Groups(['message:read'])]
    public ?UserResource $author = null;

    #[Groups(['message:read', 'message:write'])]
    public ?string $messageText = null;
}
