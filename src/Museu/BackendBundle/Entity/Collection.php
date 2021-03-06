<?php

namespace Museu\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Collection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @var integer
     *
     * @ORM\Column(name="acervo_id", type="integer")
     */
    private $acervo_id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @var integer
     *
     * @ORM\Column(name="statement_category", type="string", length=255, nullable=true)
     */
    private $statement_category;

    /**
     * @var integer
     *
     * @ORM\Column(name="vehicle", type="string", length=255, nullable=true)
     */
    private $vehicle;

    /**
     * @var string
     *
     * @ORM\Column(name="program", type="string", length=255, nullable=true)
     */
    private $program;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="acervo_date", type="date", nullable=true)
     */
    private $acervo_date;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="text", nullable=true)
     */
    private $keyword;

    /**
     * @var string
     *
     * @ORM\Column(name="pic", type="string", length=255, nullable=true)
     */
    private $pic;

    /**
     * @var string
     *
     * @ORM\Column(name="support_pic", type="string", length=255, nullable=true)
     */
    private $support_pic;

    /**
     * @var string
     *
     * @ORM\Column(name="support_pic_author", type="string", length=255, nullable=true)
     */
    private $support_pic_author;

    /**
     * @var string
     *
     * @ORM\Column(name="related", type="string", length=255, nullable=true)
     */
    private $related;

    /**
     * @var string
     *
     * @ORM\Column(name="interpret", type="string", length=255, nullable=true)
     */
    private $interpret;

    /**
     * @var string
     *
     * @ORM\Column(name="composer", type="string", length=255, nullable=true)
     */
    private $composer;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_visit", type="integer", nullable=true)
     */
    private $total_visit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=true)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255, nullable=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="resenha", type="string", length=255, nullable=true)
     */
    private $resenha;

    /**
     * @var string
     *
     * @ORM\Column(name="ebook", type="string", length=255, nullable=true)
     */
    private $ebook;

    /**
     * @var string
     *
     * @ORM\Column(name="library", type="string", length=255, nullable=true)
     */
    private $library;

    /**
     * @var string
     *
     * @ORM\Column(name="next_library", type="string", length=255, nullable=true)
     */
    private $next_library;

    /**
     * @var string
     *
     * @ORM\Column(name="sebo", type="string", length=255, nullable=true)
     */
    private $sebo;

    /**
     * @var string
     *
     * @ORM\Column(name="sinopse", type="text", nullable=true)
     */
    private $sinopse;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=255, nullable=true)
     */
    private $publisher;

    /**
     * @var string
     *
     * @ORM\Column(name="cinegrafista", type="string", length=255, nullable=true)
     */
    private $cinegrafista;

    /**
     * @var string
     *
     * @ORM\Column(name="elenco", type="string", length=255, nullable=true)
     */
    private $elenco;



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
     * Set category
     *
     * @param string $category
     * @return Collection
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function getNiceCategory()
    {
        switch ($this->category) {
            case 'clipes-musicais':
                return "Clipes Musicais";
                break;
            case 'tv': 
                return "TV";
                break;
            case 'documentarios':
                return "Documentários";
                break;
            default:
                return $this->category;

        }
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Collection
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set vehicle
     *
     * @param string $vehicle
     * @return Collection
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    
        return $this;
    }

    /**
     * Get vehicle
     *
     * @return string 
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set program
     *
     * @param string $program
     * @return Collection
     */
    public function setProgram($program)
    {
        $this->program = $program;
    
        return $this;
    }

    /**
     * Get program
     *
     * @return string 
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Collection
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    
        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Collection
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

    /**
     * Set acervo_date
     *
     * @param \DateTime $acervoDate
     * @return Collection
     */
    public function setAcervoDate($acervoDate)
    {
        $this->acervo_date = $acervoDate;
    
        return $this;
    }

    /**
     * Get acervo_date
     *
     * @return \DateTime 
     */
    public function getAcervoDate()
    {
        return $this->acervo_date;
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
     * Set pic
     *
     * @param string $pic
     * @return Collection
     */
    public function setPic($pic)
    {
        $this->pic = $pic;
    
        return $this;
    }

    /**
     * Get pic
     *
     * @return string 
     */
    public function getPic()
    {
        return $this->pic;
    }

    /**
     * Set support_pic
     *
     * @param string $supportPic
     * @return Collection
     */
    public function setSupportPic($supportPic)
    {
        $this->support_pic = $supportPic;
    
        return $this;
    }

    /**
     * Get support_pic
     *
     * @return string 
     */
    public function getSupportPic()
    {
        return $this->support_pic;
    }

    /**
     * Set support_pic_author
     *
     * @param string $supportPicAuthor
     * @return Collection
     */
    public function setSupportPicAuthor($supportPicAuthor)
    {
        $this->support_pic_author = $supportPicAuthor;
    
        return $this;
    }

    /**
     * Get support_pic_author
     *
     * @return string 
     */
    public function getSupportPicAuthor()
    {
        return $this->support_pic_author;
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

    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
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
     * Set total_visit
     *
     * @param integer $totalVisit
     * @return Collection
     */
    public function setTotalVisit($totalVisit)
    {
        $this->total_visit = $totalVisit;
    
        return $this;
    }

    /**
     * Get total_visit
     *
     * @return integer 
     */
    public function getTotalVisit()
    {
        return $this->total_visit;
    }

    /**
     * Set related
     *
     * @param string $related
     * @return Collection
     */
    public function setRelated($related)
    {
        $this->related = $related;
    
        return $this;
    }

    /**
     * Get related
     *
     * @return string 
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * Set interpret
     *
     * @param string $interpret
     * @return Collection
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
     * Set body
     *
     * @param string $body
     * @return Collection
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set acervo_id
     *
     * @param integer $acervoId
     * @return Collection
     */
    public function setAcervoId($acervoId)
    {
        $this->acervo_id = $acervoId;
    
        return $this;
    }

    /**
     * Get acervo_id
     *
     * @return integer 
     */
    public function getAcervoId()
    {
        return $this->acervo_id;
    }

    /**
     * Set composer
     *
     * @param string $composer
     * @return Collection
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
     * Set function
     *
     * @param string $function
     * @return Collection
     */
    public function setFunction($function)
    {
        $this->function = $function;
    
        return $this;
    }

    /**
     * Get function
     *
     * @return string 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set statement_category
     *
     * @param string $statementCategory
     * @return Collection
     */
    public function setStatementCategory($statementCategory)
    {
        $this->statement_category = $statementCategory;
    
        return $this;
    }

    /**
     * Get statement_category
     *
     * @return string 
     */
    public function getStatementCategory()
    {
        return $this->statement_category;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Collection
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    
        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set year
     *
     * @param string $year
     * @return Collection
     */
    public function setYear($year)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year
     *
     * @return string 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set resenha
     *
     * @param string $resenha
     * @return Collection
     */
    public function setResenha($resenha)
    {
        $this->resenha = $resenha;
    
        return $this;
    }

    /**
     * Get resenha
     *
     * @return string 
     */
    public function getResenha()
    {
        return $this->resenha;
    }

    /**
     * Set ebook
     *
     * @param string $ebook
     * @return Collection
     */
    public function setEbook($ebook)
    {
        $this->ebook = $ebook;
    
        return $this;
    }

    /**
     * Get ebook
     *
     * @return string 
     */
    public function getEbook()
    {
        return $this->ebook;
    }

    /**
     * Set library
     *
     * @param string $library
     * @return Collection
     */
    public function setLibrary($library)
    {
        $this->library = $library;
    
        return $this;
    }

    /**
     * Get library
     *
     * @return string 
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * Set next_library
     *
     * @param string $nextLibrary
     * @return Collection
     */
    public function setNextLibrary($nextLibrary)
    {
        $this->next_library = $nextLibrary;
    
        return $this;
    }

    /**
     * Get next_library
     *
     * @return string 
     */
    public function getNextLibrary()
    {
        return $this->next_library;
    }

    /**
     * Set sebo
     *
     * @param string $sebo
     * @return Collection
     */
    public function setSebo($sebo)
    {
        $this->sebo = $sebo;
    
        return $this;
    }

    /**
     * Get sebo
     *
     * @return string 
     */
    public function getSebo()
    {
        return $this->sebo;
    }

    /**
     * Set sinopse
     *
     * @param string $sinopse
     * @return Collection
     */
    public function setSinopse($sinopse)
    {
        $this->sinopse = $sinopse;
    
        return $this;
    }

    /**
     * Get sinopse
     *
     * @return string 
     */
    public function getSinopse()
    {
        return $this->sinopse;
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
     * Set cinegrafista
     *
     * @param string $cinegrafista
     * @return Collection
     */
    public function setCinegrafista($cinegrafista)
    {
        $this->cinegrafista = $cinegrafista;
    
        return $this;
    }

    /**
     * Get cinegrafista
     *
     * @return string 
     */
    public function getCinegrafista()
    {
        return $this->cinegrafista;
    }

    /**
     * Set elenco
     *
     * @param string $elenco
     * @return Collection
     */
    public function setElenco($elenco)
    {
        $this->elenco = $elenco;
    
        return $this;
    }

    /**
     * Get elenco
     *
     * @return string 
     */
    public function getElenco()
    {
        return $this->elenco;
    }
}