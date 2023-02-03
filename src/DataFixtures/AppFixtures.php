<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = new Users();
        $users->setUsername('Admin');
        $users->setRoles(['ROLE_ADMIN']);
        $users->setPassword('$2y$13$5dMaT/suYj7ygAW9W5H/S.jQGYH5YlEmMV9dmApq5ZGnBoEks5yQW');

        $users = new Users();
        $users->setUsername('UserTest');
        $users->setRoles(['ROLE_USER']);
        $users->setPassword('$2y$13$mj113bbBEpHmaO2d/T5k7OA8SOkS1/PcftMAbBBiK9GEX4yQ.OWFy');

        $manager->flush();
    }
}
