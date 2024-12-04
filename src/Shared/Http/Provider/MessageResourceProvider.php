<?php

namespace App\Shared\Http\Provider;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Message\Entity\Message;
use App\Message\Repository\MessageRepository;
use App\Shared\Http\Factory\MessageResourceFactory;

class MessageResourceProvider implements ProviderInterface
{
    public function __construct(
        private readonly MessageRepository $messageRepository,
        private readonly MessageResourceFactory $messageResourceFactory,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof GetCollection) {
            return $this->provideCollection($context);
        }
        $message = $this->messageRepository->findOrFail($uriVariables['id']);

        return $this->messageResourceFactory->createFromMessage($message);
    }

    private function provideCollection(array $context)
    {
        $query = $this->messageRepository;

        $filters = $context['filters'] ?? [];

        if (isset($filters['age']['min'])) {
            $query = $query
                ->withAgeGraterThen($filters['age']['min']);
        }

        if (isset($filters['age']['max'])) {
            $query = $query
                ->withAgeLessThen($filters['age']['max']);
        }

        if (isset($filters['city_id'])) {
            $query = $query->withCity($filters['city_id']);
        }

        $messages = $query->get();

        return array_map(function (Message $message) {
            return $this->messageResourceFactory->createFromMessage($message);
        }, $messages);
    }
}
