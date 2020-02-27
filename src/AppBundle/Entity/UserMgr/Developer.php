<?php

namespace AppBundle\Entity\UserMgr;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Developer
 *
 * @ORM\Table(name="developer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserMgr\DeveloperRepository")
 */
class Developer extends User {

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
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

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
     * Set company
     *
     * @param string $company
     *
     * @return Developer
     */
    public function setCompany($company) {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany() {
        return $this->company;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Developer
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
     * @return Developer
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Videogame", mappedBy="developer")
     */
    private $videogames;

    public function __construct() {
        parent::__construct();
        $this->videogames = new ArrayCollection();
    }

    function getVideogames() {
        return $this->videogames;
    }

    function addVideogame($videogame) {
        $this->videogames . add($videogame);
    }

    function removeVideogame($videogame) {
        $this->videogames . remove($videogame);
    }

    public function __toString() {
        return $this->getUsername();
    }

    public function getRoles() {
        return ['ROLE_USER_DEVELOPER'];
    }

}
