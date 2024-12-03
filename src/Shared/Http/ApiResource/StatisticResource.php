<?php

namespace App\Shared\Http\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Analytic\StatisticDTO;
use App\Shared\Http\Provider\StatisticResourceProvider;

#[ApiResource(
    shortName: 'statistic',
    operations: [
        new GetCollection(),
    ],
    provider: StatisticResourceProvider::class,
    paginationEnabled: false
)]
class StatisticResource
{
    #[ApiProperty(
        identifier: true
    )]
    public ?string $userId = null;
    public ?string $userName = null;
    public ?string $messageCount = null;

    public static function fromStatisticDTO(StatisticDTO $dto): self
    {
        $self = new self();

        $self->userId = $dto->userId;
        $self->userName = $dto->userName;
        $self->messageCount = $dto->messageCount;

        return $self;
    }
}
