<?php

namespace Omitsis\SampleAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="boat")
 */
class Boat
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
     * @var boolean $active
     * @ORM\Column(type="boolean")
     */
    protected $active;
    
    /**
    * @ORM\ManyToOne(targetEntity="Omitsis\SampleAppBundle\Entity\User", inversedBy="boats", cascade={"persist"})
    * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=false)
    */
    protected $owner;
    
    /**
    * @ORM\ManyToOne(targetEntity="Omitsis\SampleAppBundle\Entity\City", inversedBy="boats", cascade={"persist"})
    * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
    */
    protected $city;

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
     * @return Boat
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
     * Set active
     *
     * @param boolean $active
     * @return Boat
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set owner
     *
     * @param \Omitsis\SampleAppBundle\Entity\User $owner
     * @return Boat
     */
    public function setOwner(\Omitsis\SampleAppBundle\Entity\User $owner)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return \Omitsis\SampleAppBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set city
     *
     * @param \Omitsis\SampleAppBundle\Entity\City $city
     * @return Boat
     */
    public function setCity(\Omitsis\SampleAppBundle\Entity\City $city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return \Omitsis\SampleAppBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
    
    public function __toString() {
        return $this->name;
    }
}