<?php
/**
 * this is for namespace
 */
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * this is the review
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * this is auto generated
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * this is the actual text content review
     * @Assert\Length (min = 10,max = 250)
     * @ORM\Column(type ="string")
     */
    private $review;

    /**
     * this is for Location of purchase
     * @ORM\Column(type ="string")
     */
    private $placeOfPurchase;
    /**
     * this is for the Price paid
     * @ORM\Column(type ="float")
     */
    private $pricePaid;
    /**
     * this is for the num of stars
     * @ORM\Column(type ="decimal", scale=1)
     */
    private $numOfStars;
    /**
     * this is to link to users reviews
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reviews")
     * @ORM\Column(nullable=true)
     */
    private $user;
    /**
     * this is for the Date of purchase
     * @ORM\Column(type ="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Port", inversedBy="productReviews")
     * @ORM\JoinColumn(name="port_id", referencedColumnName="id")
     */
    private $port;
    /**
     * This is to see if the port is public or not
     * @ORM\Column(type ="boolean")
     */
    private $isPublic;
    /**
     * this is for votes
     * @ORM\Column(type = "integer",nullable=true,options={"default" : 0})
     */
    private $votes;
    /**
     * this is if the user wants to make port private
     * @ORM\Column(type ="boolean")
     */
    private $doesUserWantToMakePublic;





    /**
     * this is to get user and allows for null
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * this sets a user and allows it to be null
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



    /**
     * this gets the port and allows for null
     * @return mixed
     */
    public function getPort():?Port
    {
        return $this->port;
    }

    /**
     * this sets port and allows for null
     * @param mixed $port
     */
    public function setPort(Port $port = null): void
    {
        $this->port = $port;
    }

    /**
     * this gets the id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * this sets the id
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * this gets the review
     * @return mixed
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * this sets the review
     * @param mixed $review
     */
    public function setReview($review): void
    {
        $this->review = $review;
    }

    /**
     * this gets place of purchase
     * @return mixed
     */
    public function getPlaceOfPurchase()
    {
        return $this->placeOfPurchase;
    }

    /**
     * sets the place of purchase
     * @param mixed $placeOfPurchase
     */
    public function setPlaceOfPurchase($placeOfPurchase): void
    {
        $this->placeOfPurchase = $placeOfPurchase;
    }

    /**
     * this gets price paid
     * @return mixed
     */
    public function getPricePaid()
    {
        return $this->pricePaid;
    }

    /**
     * this sets price paid
     * @param mixed $pricePaid
     */
    public function setPricePaid($pricePaid): void
    {
        $this->pricePaid = $pricePaid;
    }

    /**
     * this gets the number of stars
     * @return mixed
     */
    public function getNumOfStars()
    {
        return $this->numOfStars;
    }

    /**
     * sets the number of stars
     * @param mixed $numOfStars
     */
    public function setNumOfStars($numOfStars): void
    {
        $this->numOfStars = $numOfStars;
    }

    /**
     * this gets the date
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * this sets the date
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * this is to get if it is public
     * @return mixed
     */
    public function getisPublic()
    {
        return $this->isPublic;
    }

    /**
     * this is to set if it is public
     * @param mixed $isPublic
     */
    public function setIsPublic($isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }

    /**
     * @return mixed
     */
    public function getDoesUserWantToMakePublic()
    {
        return $this->doesUserWantToMakePublic;
    }

    /**
     * @param mixed $doesUserWantToMakePublic
     */
    public function setDoesUserWantToMakePublic($doesUserWantToMakePublic): void
    {
        $this->doesUserWantToMakePublic = $doesUserWantToMakePublic;
    }




}
