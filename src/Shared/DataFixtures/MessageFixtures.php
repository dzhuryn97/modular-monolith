<?php

namespace App\Shared\DataFixtures;

use App\Message\MessageService;
use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MessageService $messageService,
    ) {
    }

    public function loadData(ObjectManager $manager)
    {
        $users = $this->userRepository->get();

        for ($i = 0; $i < 10; ++$i) {
            /** @var User $user */
            $user = $this->faker->randomElement($users);
            $this->messageService->publishMessage(
                userId: $user->getId(),
                messageText: $this->faker->text(500)
            );
        }
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
