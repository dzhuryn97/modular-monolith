<?php

namespace App\Message;

use App\Bill\Service\BillService;
use App\Message\Entity\Message;
use App\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class MessageService
{
    public function __construct(
        private readonly BillService $billService,
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

        $this->billService->chargeMoney($userId, $this->messagePrice);

        $this->em->flush();

        return $message;
    }
}
