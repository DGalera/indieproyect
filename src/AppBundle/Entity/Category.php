<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category implements \Serializable {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * Set description
     *
     * @param string $description
     *
     * @return Category
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
     * @ORM\OneToMany(targetEntity="Videogame", mappedBy="category")
     */
    private $videogames;

    function getVideogames() {
        return $this->videogames;
    }

    function addVideogame($videogame) {
        $this->videogames . add($videogame);
    }

    function removeVideogame($videogame) {
        $this->videogames . remove($videogame);
    }

    public function __construct() {
        $this->videogames = new ArrayCollection();
    }

    public function serialize() {
        return serialize([
            $this->id,
            $this->name,
            $this->description,
            $this->videogames
        ]);
    }

    public function unserialize($serialized){
        list (
                $this->id,
                $this->name,
                $this->description,
                $this->videogames
                ) = unserialize($serialized, ['allowed_classes' => FALSE]);
    }

    public function __toString() {
        return $this->name;
    }

}
