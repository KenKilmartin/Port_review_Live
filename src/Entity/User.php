<?php
/**
 * this is for namespace
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * this is for the user
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * this is auto generated for the id
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * this is the users user name
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * this is for the users password
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * this takes the roles and stores them in array
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * this is not being used any more as using bcrypt but dont want to delete as its not harming anyone
     * @return null|string
     */
    public function getSalt()
    {
        // no salt needed since we are using bcrypt
        return null;
    }

    /**
     * this needs to be here but if take out errors come
     */
    public function eraseCredentials()
    {
    }
    /**
     * see \Serializable::serialize()
     * this serializes password
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * this unserializes
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * this gets the roles
     * @return array
     */
    public function getRoles()
    {
//        $roles = $this->roles;
//        // ensure always contains ROLE_USER
//        $roles[] = 'ROLE_USER';
//
//        return array_unique($roles);
        return $this->roles;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
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
     * this gets the username
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * this sets the username
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * this gets the password
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * this sets the password
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * this is to link user back to reviews
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="user")
     */
    private $reviews;
    /**
     * this is to get reviews
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * this is to set review
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }
    /**
     * this is a magic method
     * @return string
     */
    public function __toString()
    {

        return "{$this->username}";
    }
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }


}