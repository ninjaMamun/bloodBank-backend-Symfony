<?php

namespace App\DataFixtures;

use App\Entity\Area;
use App\Entity\Donor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class DonorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $donor1 = new Donor();

        $donor1->setBloodGroup("B+");
        $donor1->setName("Mamun");
        $donor1->setMobile("01887676123");
        $donor1->setMail("mail@shahriyar.me");
        $donor1->setProfilePicture("https://cdn.pixabay.com/photo/2022/10/14/09/57/crab-7520956__480.jpg");
        $donor1 -> setArea($this->getReference('Chandipur'));
        $manager->persist($donor1);

        $donor2 = new Donor();

        $donor2->setBloodGroup("B+");
        $donor2->setName("Saidul");
        $donor2->setMobile("01111111111");
        $donor2->setMail("mail@saidul.me");
        $donor2->setProfilePicture("https://cdn.pixabay.com/photo/2022/10/14/09/57/crab-7520956__480.jpg");
        $donor2 -> setArea($this->getReference('Bhawal'));

//        $date_stamp = '2014-08-06 00:00:00';
//        $date = new Date($date_stamp);
//        $donor2 ->setLastDonateDate($date);

        $manager->persist($donor2);

        $manager->flush();
    }
}
