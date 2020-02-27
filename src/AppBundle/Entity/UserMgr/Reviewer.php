<?php

namespace AppBundle\Entity\UserMgr;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Reviewer
 *
 * @ORM\Table(name="reviewer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserMgr\ReviewerRepository")
 */
class Reviewer extends User {

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
     * @ORM\Column(name="web", type="string", length=255)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surnames", type="string", length=255)
     */
    private $surnames;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set web
     *
     * @param string $web
     *
     * @return Reviewer
     */
    public function setWeb($web) {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb() {
        return $this->web;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Reviewer
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set surnames
     *
     * @param string $surnames
     *
     * @return Reviewer
     */
    public function setSurnames($surnames) {
        $this->surnames = $surnames;

        return $this;
    }

    /**
     * Get surnames
     *
     * @return string
     */
    public function getSurnames() {
        return $this->surnames;
    }

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="reviewer")
     */
    private $reviews;

    function getReviews() {
        return $this->reviews;
    }
    
    function getNumReviews() {
        return $this->reviews->count();
    }

    function addReview($review) {
        $this->reviews . add($review);
    }

    function removeReview($review) {
        $this->reviews . remove($review);
    }

    public function __construct() {
        parent::__construct();
        $this->reviews = new ArrayCollection();
    }

    public function __toString() {
        return $this->getUsername();
    }

    public function getRoles() {
        return ['ROLE_USER_REVIEWER'];
    }

}
