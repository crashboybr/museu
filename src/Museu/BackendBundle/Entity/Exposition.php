<?php

namespace Museu\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Exposition
 *
 * @ORM\Table(name="exposition")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Exposition
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
     * @Assert\NotBlank(
     *      message = "Escreva o Título"
     *)
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

     /**
     * @var string
     * @Assert\NotBlank(
     *      message = "Escreva o Sub-Título"
     *)
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var string
     * @Assert\NotBlank(
     *      message = "Escreva a Descrição"
     *)
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(
     *      message = "Escreva a Descrição simples"
     *)
     * @ORM\Column(name="short_description", type="text")
     */
    private $short_description;

    /**
     * @var \DateTime
     * @Assert\NotBlank(
     *      message = "Escolha a Data"
     *)
     * @ORM\Column(name="date", type="date")
     */
    private $date;


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
     * @ORM\OneToMany(targetEntity="ExpositionImage", mappedBy="expositions", cascade={"ALL"})
     */
    protected $exposition_images;

    /**
     * @ORM\OneToMany(targetEntity="ExpositionAuthor", mappedBy="expositions", cascade={"ALL"})
     */
    protected $exposition_authors;


    public function __construct()
    {
        $this->exposition_images = new ArrayCollection();
        $this->exposition_authors = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Exposition
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
     * Set description
     *
     * @param string $description
     * @return Exposition
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Exposition
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Exposition
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
     * @return Exposition
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

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime(date('Y-m-d H:i:s')));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
    }

    /**
     * Add exposition_images
     *
     * @param \Museu\BackendBundle\Entity\ExpositionImage $expositionImages
     * @return Exposition
     */
    public function addExpositionImage(\Museu\BackendBundle\Entity\ExpositionImage $expositionImages)
    {
        $this->exposition_images[] = $expositionImages;
    
        return $this;
    }

    /**
     * Remove exposition_images
     *
     * @param \Museu\BackendBundle\Entity\ExpositionImage $expositionImages
     */
    public function removeExpositionImage(\Museu\BackendBundle\Entity\ExpositionImage $expositionImages)
    {
        $this->exposition_images->removeElement($expositionImages);
    }

    /**
     * Get exposition_images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExpositionImages()
    {
        return $this->exposition_images;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Exposition
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
     * Add exposition_authors
     *
     * @param \Museu\BackendBundle\Entity\ExpositionAuthor $expositionAuthors
     * @return Exposition
     */
    public function addExpositionAuthor(\Museu\BackendBundle\Entity\ExpositionAuthor $expositionAuthors)
    {
        $this->exposition_authors[] = $expositionAuthors;
    
        return $this;
    }

    /**
     * Remove exposition_authors
     *
     * @param \Museu\BackendBundle\Entity\ExpositionAuthor $expositionAuthors
     */
    public function removeExpositionAuthor(\Museu\BackendBundle\Entity\ExpositionAuthor $expositionAuthors)
    {
        $this->exposition_authors->removeElement($expositionAuthors);
    }

    /**
     * Get exposition_authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExpositionAuthors()
    {
        return $this->exposition_authors;
    }

    /**
     * Set short_description
     *
     * @param string $shortDescription
     * @return Exposition
     */
    public function setShortDescription($shortDescription)
    {
        $this->short_description = $shortDescription;
    
        return $this;
    }

    /**
     * Get short_description
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }
}