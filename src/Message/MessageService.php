<?php

namespace App\Message;

use App\Bill\Client\ClientInterface as BillClient;
use App\Message\Entity\Message;
use App\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class MessageService
{
    public function __construct(
        private readonly BillClient $billClient,
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $em,
        private readonly int $messagePrice = 50,
    ) {
    }

    public function publishMessage(
        UuidInterface $userId,
        string $messageText,
    ) {
        $author = $this->userRepository->findOrFail($userId);

        $message = new Message();
        $message->setAuthor($author);
        $message->setMessageText($messageText);
        $this->em->persist($message);

        $this->billClient->chargeMoney($userId, $this->messagePrice);

        $this->em->flush();

        return $message;
    }
}
