<?php

namespace App\Analytic\EventListener;

use App\Analytic\AnalyticService;
use App\User\IntegrationEvent\UserCreateIntegrationEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class UserCreatedListener
{
    public function __construct(
        private readonly AnalyticService $analyticService,
    ) {
    }

    public function __invoke(UserCreateIntegrationEvent $event): void
    {
        $fullName = $event->firstName.' '.$event->lastName;

        $this->analyticService->createStatistic(
            $event->userId,
            $fullName,
        );
    }
}
