<?php

namespace App\Shared\Http\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Message\MessageService;
use App\Shared\Http\ApiResource\MessageResource;
use Symfony\Bundle\SecurityBundle\Security;

class CreateMessageProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly MessageService $messageService,
        private readonly Security $security,
    ) {
    }

    /**
     * @param MessageResource $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $message = $this->messageService->publishMessage(
            userId: $this->security->getUser()->getId(),
            messageText: $data->messageText,
        );

        return MessageResource::fromMessage($message);
    }
}
