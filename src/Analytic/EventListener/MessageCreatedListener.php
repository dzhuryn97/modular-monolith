<?php

namespace App\Analytic\EventListener;

use App\Analytic\AnalyticService;
use App\Message\IntegrationEvent\MessageCreatedIntegrationEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class MessageCreatedListener
{
    public function __construct(
        private readonly AnalyticService $analyticService,
    ) {
    }

    public function __invoke(MessageCreatedIntegrationEvent $event): void
    {
        $this->analyticService->incrementStatistic($event->authorId);
    }
}
