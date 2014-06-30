<?php

namespace Museu\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Collection
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Collection
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="collection_type_id", type="integer")
     */
    private $collectionTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="author_collection_id", type="integer")
     */
    private $authorCollectionId;

    /**
     * @var string
     *
     * @ORM\Column(name="photographer", type="string", length=255)
     */
    private $photographer;

    /**
     * @var string
     *
     * @ORM\Column(name="midia", type="string", length=255)
     */
    private $midia;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=255)
     */
    private $publisher;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="string", length=255)
     */
    private $keyword;

    /**
     * @var string
     *
     * @ORM\Column(name="facsimile", type="string", length=255)
     */
    private $facsimile;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255)
     */
    private $video;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


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
     * Set title
     *
     * @param string $title
     * @return Collection
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Collection
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    
        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set collectionTypeId
     *
     * @param integer $collectionTypeId
     * @return Collection
     */
    public function setCollectionTypeId($collectionTypeId)
    {
        $this->collectionTypeId = $collectionTypeId;
    
        return $this;
    }

    /**
     * Get collectionTypeId
     *
     * @return integer 
     */
    public function getCollectionTypeId()
    {
        return $this->collectionTypeId;
    }

    /**
     * Set authorCollectionId
     *
     * @param integer $authorCollectionId
     * @return Collection
     */
    public function setAuthorCollectionId($authorCollectionId)
    {
        $this->authorCollectionId = $authorCollectionId;
    
        return $this;
    }

    /**
     * Get authorCollectionId
     *
     * @return integer 
     */
    public function getAuthorCollectionId()
    {
        return $this->authorCollectionId;
    }

    /**
     * Set photographer
     *
     * @param string $photographer
     * @return Collection
     */
    public function setPhotographer($photographer)
    {
        $this->photographer = $photographer;
    
        return $this;
    }

    /**
     * Get photographer
     *
     * @return string 
     */
    public function getPhotographer()
    {
        return $this->photographer;
    }

    /**
     * Set midia
     *
     * @param string $midia
     * @return Collection
     */
    public function setMidia($midia)
    {
        $this->midia = $midia;
    
        return $this;
    }

    /**
     * Get midia
     *
     * @return string 
     */
    public function getMidia()
    {
        return $this->midia;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     * @return Collection
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    
        return $this;
    }

    /**
     * Get publisher
     *
     * @return string 
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Collection
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return Collection
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    
        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set facsimile
     *
     * @param string $facsimile
     * @return Collection
     */
    public function setFacsimile($facsimile)
    {
        $this->facsimile = $facsimile;
    
        return $this;
    }

    /**
     * Get facsimile
     *
     * @return string 
     */
    public function getFacsimile()
    {
        return $this->facsimile;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Collection
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return Collection
     */
    public function setVideo($video)
    {
        $this->video = $video;
    
        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Collection
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

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Collection
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
