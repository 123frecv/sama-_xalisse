<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 4; $i++){
            $roles = new Role();
            $roles->setLibelle("superadmin $i");
            
            $manager->persist($roles);
        }
        
         
        $user = new User();
        $user->setUsername('admin');
        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        $user->setNomcompl('sisco');
        $user->setIsActif(true);
        $user->setRoles((array("ROLE_USER")));
            
        $manager->persist($user);
        $manager->flush();
        

        $manager->flush();
    }
}
