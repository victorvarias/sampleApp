<?php

namespace Omitsis\SampleAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class City
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $name
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $name;
    
    /**
    * @ORM\OneToMany(targetEntity="Omitsis\SampleAppBundle\Entity\Boat", mappedBy="city")
    */
    protected $boats;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->boats = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add boats
     *
     * @param \Omitsis\SampleAppBundle\Entity\User $boats
     * @return City
     */
    public function addBoat(\Omitsis\SampleAppBundle\Entity\User $boats)
    {
        $this->boats[] = $boats;
    
        return $this;
    }

    /**
     * Remove boats
     *
     * @param \Omitsis\SampleAppBundle\Entity\User $boats
     */
    public function removeBoat(\Omitsis\SampleAppBundle\Entity\User $boats)
    {
        $this->boats->removeElement($boats);
    }

    /**
     * Get boats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBoats()
    {
        return $this->boats;
    }
    
    public function __toString() {
        return $this->name;
    }
}