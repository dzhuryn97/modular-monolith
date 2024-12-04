<?php

namespace App\Shared\DataFixtures;

use App\User\Service\UserService;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    public const ADMIN_EMAIL = 'admin@example.com';
    public const PASSWORD = 'password';

    public function __construct(
        private readonly UserService $userService,
    ) {
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->userService->createUser(
            firstName: $this->faker->firstName(),
            lastName: $this->faker->lastName(),
            email: self::ADMIN_EMAIL,
            password: self::PASSWORD,
            cityId: $this->faker->numberBetween(1, 10),
            age: $this->faker->numberBetween(18, 60),
        );

        for ($i = 0; $i < 10; ++$i) {
            $this->userService->createUser(
                firstName: $this->faker->firstName(),
                lastName: $this->faker->lastName(),
                email: $this->faker->unique()->safeEmail(),
                password: self::PASSWORD,
                cityId: $this->faker->numberBetween(1, 10),
                age: $this->faker->numberBetween(18, 60),
            );
        }
    }
}
