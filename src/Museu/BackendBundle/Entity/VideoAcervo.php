<?php

namespace Museu\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VideoAcervo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class VideoAcervo
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="director", type="string", length=255, nullable=true)
     */
    private $director;

    /**
     * @var string
     *
     * @ORM\Column(name="composer", type="string", length=255, nullable=true)
     */
    private $composer;

    /**
     * @var string
     *
     * @ORM\Column(name="interpret", type="string", length=255, nullable=true)
     */
    private $interpret;

    /**
     * @var string
     *
     * @ORM\Column(name="producer", type="string", length=255, nullable=true)
     */
    private $producer;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;


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
     * @return VideoAcervo
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
     * Set director
     *
     * @param string $director
     * @return VideoAcervo
     */
    public function setDirector($director)
    {
        $this->director = $director;
    
        return $this;
    }

    /**
     * Get director
     *
     * @return string 
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set composer
     *
     * @param string $composer
     * @return VideoAcervo
     */
    public function setComposer($composer)
    {
        $this->composer = $composer;
    
        return $this;
    }

    /**
     * Get composer
     *
     * @return string 
     */
    public function getComposer()
    {
        return $this->composer;
    }

    /**
     * Set interpret
     *
     * @param string $interpret
     * @return VideoAcervo
     */
    public function setInterpret($interpret)
    {
        $this->interpret = $interpret;
    
        return $this;
    }

    /**
     * Get interpret
     *
     * @return string 
     */
    public function getInterpret()
    {
        return $this->interpret;
    }

    /**
     * Set producer
     *
     * @param string $producer
     * @return VideoAcervo
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    
        return $this;
    }

    /**
     * Get producer
     *
     * @return string 
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return VideoAcervo
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}