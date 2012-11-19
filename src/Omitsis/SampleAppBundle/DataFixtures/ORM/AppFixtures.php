<?php

namespace Omitsis\SampleAppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Omitsis\SampleAppBundle\Entity\User;
use Omitsis\SampleAppBundle\Entity\City;
use Omitsis\SampleAppBundle\Entity\Boat;

class AppFixtures implements FixtureInterface
{
    private $em;
    
    public function load(ObjectManager $em)
    {
        $this->em = $em;
        $u1 = $this->createUser('John');
        $u2 = $this->createUser('Mike');
        $u3 = $this->createUser('Maria');
        
        $c1 = $this->createCity('Barcelona');
        $c2 = $this->createCity('Mataro');
        $c3 = $this->createCity('Sitges');
        
        $this->createBoat('Boat1', true, $u1, $c1);
        $this->createBoat('Boat2', false, $u1, $c2);
        $this->createBoat('Boat3', true, $u1, $c2);
        $this->createBoat('Boat4', true, $u1, $c3);
        
        $this->createBoat('Boat5', true, $u2, $c1);
        $this->createBoat('Boat6', true, $u2, $c2);
        $this->createBoat('Boat7', false, $u2, $c3);
        
        $this->createBoat('Boat8', true, $u3, $c3);

        $em->flush();
    }
    
    public function createUser($name){
        $user = new User();
        $user->setName($name);
        $this->em->persist($user);
        return $user;
    }
    
    public function createCity($name){
        $city = new City();
        $city->setName($name);
        $this->em->persist($city);
        return $city;
    }
    
    public function createBoat($name, $active, $user, $city){
        $boat = new Boat();
        $boat->setName($name);
        $boat->setActive($active);
        $boat->setOwner($user);
        $boat->setCity($city);
        $this->em->persist($boat);
    }

}

?>
