<?php

namespace App\Shared\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    protected Generator $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        $this->loadData($manager);
    }

    abstract public function loadData(ObjectManager $manager);
}
