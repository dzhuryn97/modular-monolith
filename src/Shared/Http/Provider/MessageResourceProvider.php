<?php

namespace App\Shared\Http\Provider;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Message\Entity\Message;
use App\Message\MessageRepository;
use App\Shared\Http\ApiResource\MessageResource;

class MessageResourceProvider implements ProviderInterface
{
    public function __construct(
        private readonly MessageRepository $messageRepository,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if ($operation instanceof GetCollection) {
            return $this->provideCollection($context);
        }
        $message = $this->messageRepository->findOrFail($uriVariables['id']);

        return MessageResource::fromMessage($message);
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
            return MessageResource::fromMessage($message);
        }, $messages);
    }
}
