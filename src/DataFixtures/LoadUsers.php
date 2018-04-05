<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;





class LoadUsers extends Fixture


{

    const AUTHOR_REFERENCE = 'user';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        // create objects
        $userUser = $this->createUser('user', 'user');
        $userAdmin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
        $userMatt = $this->createUser('matt', 'smith', ['ROLE_SUPER_ADMIN']);
        $userKen = $this->createUser('ken', 'pass', ['ROLE_SUPER_ADMIN']);

        // store to DB
        $manager->persist($userUser);
        $this->addReference(self::AUTHOR_REFERENCE."20", $userUser);
        $manager->persist($userAdmin);
        $this->addReference(self::AUTHOR_REFERENCE."21", $userAdmin);
        $manager->persist($userMatt);
        $this->addReference(self::AUTHOR_REFERENCE."22", $userMatt);
        $manager->persist($userKen);
        $this->addReference(self::AUTHOR_REFERENCE."23", $userKen);
        $manager->flush();




        // creating faker users
        for($i = 0; $i < 20; $i++)
        {
            $user = new User();

            $username = $faker->userName();

            $password = $faker->password();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
            $this->addReference(self::AUTHOR_REFERENCE.$i, $userUser);
            $manager->flush();
        }




    }

    /**
     * @param       $username
     * @param       $plainPassword
     * @param array $roles // default to ROLE_USER if no ROLE supplied
     *
     * @return User
     */
    private function createUser($username, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setRoles($roles);

        // password - and encoding
        $encodedPassword = $this->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        return $user;
    }

    private function encodePassword($user, $plainPassword):string
    {
        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }
}
