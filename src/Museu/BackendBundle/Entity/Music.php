<?php

namespace Museu\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Music
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Music
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
     * @return Music
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
     * Set composer
     *
     * @param string $composer
     * @return Music
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
     * @return Music
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
     * Set url
     *
     * @param string $url
     * @return Music
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

    public function getClassName()
    {
        return "Música";
    }
}