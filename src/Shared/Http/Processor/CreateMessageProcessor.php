<?php

namespace App\Shared\Http\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Message\Service\MessageService;
use App\Shared\Http\ApiResource\MessageResource;
use App\Shared\Http\Factory\MessageResourceFactory;
use Symfony\Bundle\SecurityBundle\Security;

class CreateMessageProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly MessageService $messageService,
        private readonly Security $security,
        private readonly MessageResourceFactory $messageResourceFactory,
    ) {
    }

    /**
     * @param MessageResource $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $message = $this->messageService->publishMessage(
            authorId: $this->security->getUser()->getId(),
            messageText: $data->messageText,
        );

        return $this->messageResourceFactory->createFromMessage($message);
    }
}
