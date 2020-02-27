<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Videogame
 *
 * @ORM\Table(name="videogame")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideogameRepository")
 */
class Videogame {

    /**
     * @var int
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
     * @ORM\Column(name="weburl", type="string", length=255)
     */
    private $weburl;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="punctuation", type="integer")
     */
    private $punctuation;

    /**
     * Get punctuation
     *
     * @return int
     */
    function getPunctuation() {
        //Calculo de la puntuacion del videojuego
        if (count($this->reviews) >= 1) {
            $punctemp = 0;
            foreach ($this->reviews as $review) {
                $punctemp += $review->getPunctuation();
            }

            return $punctemp / count($this->reviews);
        } else {
            return 0;
        }
        
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Videogame
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set weburl
     *
     * @param string $weburl
     *
     * @return Videogame
     */
    public function setWeburl($weburl) {
        $this->weburl = $weburl;

        return $this;
    }

    /**
     * Get weburl
     *
     * @return string
     */
    public function getWeburl() {
        return $this->weburl;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Videogame
     */
    public function setLogo($logo) {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo() {
        return $this->logo;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Videogame
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="videogames")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    function getCategory() {
        return $this->category;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserMgr\Developer", inversedBy="videogames")
     * @ORM\JoinColumn(name="developer_id", referencedColumnName="id")
     */
    private $developer;

    function getDeveloper() {
        return $this->developer;
    }

    function setDeveloper($developer) {
        $this->developer = $developer;
    }

    /**
     * @ORM\OneToMany(targetEntity="Resource", mappedBy="videogame")
     */
    private $resources;

    function getResources() {
        return $this->resources;
    }

    function addResource($resource) {
        $this->resources . add($resource);
    }

    function removeResource($resource) {
        $this->resources . remove($resource);
    }

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="videogame")
     */
    private $reviews;

    function getReviews() {
        return $this->reviews;
    }

    function addReview($review) {
        $this->reviews . add($review);
    }

    function removeReview($review) {
        $this->reviews . remove($review);
    }

    function __construct() {
        $this->reviews = new ArrayCollection();
        $this->resources = new ArrayCollection();
        $this->punctuation = 0;

        
    }
    
    
    public function __toString() {
        return $this->title;
    }


}
