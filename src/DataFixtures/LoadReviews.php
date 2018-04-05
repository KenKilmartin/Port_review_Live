<?php

namespace App\DataFixtures;


use App\Entity\Review;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class LoadReviews extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {


        $review = array(
            "I have just made this to take round to some friends for Port. ",
            "Goes so well with Cheese and crackers.",
            "Sweet and often enjoyed post-meal. ",
            "The result of that long ageing process is a beautifully deep.",
            "Well now, this is one fruity character... ",
            "This lovely, super-thick liquid has at turns hints of chocolate."
        );
        $placeOfPurchase = array("Porto","Lisboa","Tesco","Hennings Wine", "Amazon","Waitrose","Molloys", "Marks and Spencers");

        $numOfStars = array(0.5,1.0,1.5,2.0,2.5,3.0,3.5,4.0,4.5,5.0);

        $doesUserWantToMakePublic = array(true,false);
        $isPublic = array(true,false);
        $reviewedBy = array('User', 'Admin', 'Ken','Matt');


        for ($i = 0; $i < 50; $i++) {
            $reviews = new Review();
            $manager->persist($reviews);

            $reviews->setPort($this->getReference(LoadPorts::Port_REFERENCE.mt_rand(0,19)));
            $reviews->setUser($reviewedBy[mt_rand(0, count($reviewedBy)-1)]);;
            $reviews->setDate($this->randomDate());
            $reviews->setReview($review[mt_rand(0,count($review)-1)]);
            $reviews->setPlaceOfPurchase($placeOfPurchase[mt_rand(0,count($placeOfPurchase)-1)]);
            $reviews->setPricePaid(mt_rand(10, 100));
            $reviews->setNumOfStars($numOfStars[mt_rand(0,count($numOfStars)-1)]);
            $reviews->setDoesUserWantToMakePublic($doesUserWantToMakePublic[mt_rand(0,count($doesUserWantToMakePublic)-1)]);
            $reviews->setIsPublic($isPublic[mt_rand(0,count($isPublic)-1)]);
            $reviews->setVotes(mt_rand(-15, 100));
        }

        $manager->flush();
    }

    function randomDate()
    {

        // Generate random number
        $val = mt_rand(1199145600, 1525132800);

        // Convert back to desired date format
        return  new DateTime("@".$val);
    }

    public function getDependencies()
    {
        return array(
            LoadUsers::class,
            LoadPorts::class
        );
    }
}