<?php

namespace App\Shared\DataFixtures;

use App\User\Service\UserService;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    public function __construct(
        private readonly UserService $userService,
    ) {
    }

    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $this->userService->createUser(
                name: $this->faker->name(),
                email: $this->faker->unique()->safeEmail(),
                password: 'password',
                cityId: $this->faker->numberBetween(1, 10),
                age: $this->faker->numberBetween(18, 60),
            );
        }
    }
}
