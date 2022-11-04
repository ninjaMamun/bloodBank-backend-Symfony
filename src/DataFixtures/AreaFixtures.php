<?php

namespace App\DataFixtures;

use App\Entity\Area;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AreaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $areaList = array("Chandipur", "Kanargao", "Kathaltoli", "Bhawal", "Kolatia");

        foreach ($areaList as $area) {

            $newArea = new Area();
            $newArea->setName($area);

            $manager->persist($newArea);

            $this ->addReference($area, $newArea);
        }

        $manager->flush();
    }
}
