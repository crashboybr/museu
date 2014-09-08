<?php

namespace Museu\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FavCollection
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FavCollection
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
     * @var integer
     *
     * @ORM\Column(name="collection_id", type="integer")
     */
    private $collectionId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * Set collectionId
     *
     * @param integer $collectionId
     * @return FavCollection
     */
    public function setCollectionId($collectionId)
    {
        $this->collectionId = $collectionId;
    
        return $this;
    }

    /**
     * Get collectionId
     *
     * @return integer 
     */
    public function getCollectionId()
    {
        return $this->collectionId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FavCollection
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}