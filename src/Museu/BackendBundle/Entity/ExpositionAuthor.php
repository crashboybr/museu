<?php

namespace Museu\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpositionAuthor
 *
 * @ORM\Table(name="exposition_author")
 * @ORM\Entity
 */
class ExpositionAuthor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="exposition_id", type="integer")
     */
    private $expositionId;

    /**
     * @ORM\ManyToOne(targetEntity="Exposition", inversedBy="exposition_authors", cascade={"persist"})
     * @ORM\JoinColumn(name="exposition_id", referencedColumnName="id")
     */
    protected $expositions;



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
     * @return ExpositionAuthor
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
     * Set expositionId
     *
     * @param integer $expositionId
     * @return ExpositionAuthor
     */
    public function setExpositionId($expositionId)
    {
        $this->expositionId = $expositionId;
    
        return $this;
    }

    /**
     * Get expositionId
     *
     * @return integer 
     */
    public function getExpositionId()
    {
        return $this->expositionId;
    }

    /**
     * Set expositions
     *
     * @param \Museu\BackendBundle\Entity\Exposition $expositions
     * @return ExpositionAuthor
     */
    public function setExpositions(\Museu\BackendBundle\Entity\Exposition $expositions = null)
    {
        $this->expositions = $expositions;
    
        return $this;
    }

    /**
     * Get expositions
     *
     * @return \Museu\BackendBundle\Entity\Exposition 
     */
    public function getExpositions()
    {
        return $this->expositions;
    }
}