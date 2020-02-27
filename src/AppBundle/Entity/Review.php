<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Review
 *
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReviewRepository")
 */
class Review {

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
     * @ORM\Column(name="analysis", type="string", length=255)
     */
    private $analysis;

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
        return $this->punctuation;
    }

    /**
     * Set punctuation
     *
     * @param int $punctuation
     *
     * @return Review
     */
    function setPunctuation($punctuation) {
        $this->punctuation = $punctuation;
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
     * Set analysis
     *
     * @param string $analysis
     *
     * @return Review
     */
    public function setAnalysis($analysis) {
        $this->analysis = $analysis;

        return $this;
    }

    /**
     * Get analysis
     *
     * @return string
     */
    public function getAnalysis() {
        return $this->analysis;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserMgr\Reviewer", inversedBy="reviews")
     * @ORM\JoinColumn(name="reviewer_id", referencedColumnName="id")
     */
    private $reviewer;

    function getReviewer() {
        return $this->reviewer;
    }

    function setReviewer($reviewer) {
        $this->reviewer = $reviewer;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Videogame", inversedBy="reviews")
     * @ORM\JoinColumn(name="videogame_id", referencedColumnName="id")
     */
    private $videogame;

    function getVideogame() {
        return $this->videogame;
    }

    function setVideogame($videogame) {
        $this->videogame = $videogame;
    }

    
    public function __toString() {
        return $this->analysis;
    }


}
