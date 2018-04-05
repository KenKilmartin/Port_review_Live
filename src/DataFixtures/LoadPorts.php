<?php

namespace App\DataFixtures;

use App\Entity\Port;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;






class LoadPorts extends Fixture
{


    const Port_REFERENCE = 'port';
    public function load(ObjectManager $manager)
    {
        $portName = array("Porto cruz LBV ",
            "Tesco finest LBV",
            "Sandemans  Ruby Port",
            "Sandemans Tawny Port",
            "Offaly Ruby Port");


        $photo = array("p1.png",
            "p2.jpg",
            "p3.png",
            "p4.png",
            "p5.png",
            "p6.png",
            "p7.png",
            "p8.png",
            "p9.png",
            "p10.png",
            "p11.jpg"
            );
        $description = array("A lovely port with nodes of berries and a summer day",
            "Cold winter Port to warm your heart",
            "Full of the power, fruit and fire that distinguishes classic Porto.",
            "Clear red amber colours with a light intense body, open up to aromas of vanilla and evolved dried fruits.",
            "A warm feeling inside like a fire roaring in your stomach.");
        $ingredients = array("Grapes from Douro region",
            "Donzelinho Branco Grapes",
            "Esgana-Cão Grapes",
            "Folgasão Grapes");

        $isPublic = array(true, false);
        $doesUserWantToMakePublic = array(true, false);

        $reviewedBy = array("user", "admin", "Ken","Matt");


        for ($i = 0; $i < 20; $i++) {
            $port = new Port();

            $port->setPortName($portName[mt_rand(0, count($portName)-1)]);


            $port->setPhoto($photo[mt_rand(0, count($photo)-1)]);
            $port->setDescription($description[mt_rand(0, count($description)-1)]);
            $port->setIngredients($ingredients[mt_rand(0, count($ingredients)-1)]);
            $port->setPriceRange(mt_rand(10, 100));
            $port->setIsPublic($isPublic[mt_rand(0, count($isPublic)-1)]);
            $port->setDoesUserWantToMakePublic($doesUserWantToMakePublic[mt_rand(0, count($doesUserWantToMakePublic)-1)]);

            $port->setReviewedBy($reviewedBy[mt_rand(0, count($reviewedBy)-1)]);
            $port->setDate($this->randomDate());
            $manager->persist($port);

            // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
            $this->addReference(self::Port_REFERENCE.$i, $port);


        }

        $manager->flush();
    }

    function randomDate()
    {

        // Generate random number
        $val = mt_rand(1199145600, 1525132800);

        // Convert back to desired date format

        return new DateTime("@".$val);
    }

}