<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MicroPost;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microPost1 = new MicroPost();
        $microPost1->setTitle('Hello');
        $microPost1->setText('This is my first post');
        $microPost1->setCreated(new \DateTime());
        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Hello Second');
        $microPost2->setText('This is my second post');
        $microPost2->setCreated(new \DateTime());
        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Hello Third');
        $microPost3->setText('This is my third post');
        $microPost3->setCreated(new \DateTime());
        $manager->persist($microPost3);
        $manager->flush();
    }
}
