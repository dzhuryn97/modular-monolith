<?php

namespace App\Shared\Http\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Analytic\Statistic;
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

    public static function fromStatistic(Statistic $statistic): self
    {
        $self = new self();

        $self->userId = $statistic->getUserId();
        $self->userName = $statistic->getUserName();
        $self->messageCount = $statistic->getMessageCount();

        return $self;
    }
}
