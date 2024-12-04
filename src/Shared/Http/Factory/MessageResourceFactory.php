<?php

namespace App\Shared\Http\Factory;

use App\Message\Entity\Message;
use App\Shared\Http\ApiResource\MessageResource;
use App\Shared\Http\ApiResource\UserResource;
use App\User\Repository\UserRepository;

class MessageResourceFactory
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function createFromMessage(Message $message): MessageResource
    {
        $user = $this->userRepository->findOrFail($message->getAuthor()->getId());

        $res = new MessageResource();
        $res->id = $message->getId();
        $res->messageText = $message->getMessageText();
        $res->author = UserResource::fromUser($user);

        return $res;
    }
}
