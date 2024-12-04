<?php

namespace App\Shared\Http\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Analytic\AnalyticService;
use App\Analytic\Statistic;
use App\Shared\Http\ApiResource\StatisticResource;

class StatisticResourceProvider implements ProviderInterface
{
    public function __construct(
        private readonly AnalyticService $analyticService,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return array_map(function (Statistic $dto) {
            return StatisticResource::fromStatistic($dto);
        }, $this->analyticService->getStatistic());
    }
}
