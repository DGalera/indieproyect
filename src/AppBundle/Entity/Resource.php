<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Resource
 *
 * @ORM\Table(name="resource")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResourceRepository")
 */
class Resource {

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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Resource
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Get type
     *
     * @return string
     */
    function getType() {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Resource
     */
    function setType($type) {
        $this->type = $type;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Videogame", inversedBy="resources")
     * @ORM\JoinColumn(name="videogame_id", referencedColumnName="id")
     */
    private $videogame;

    function getVideogame() {
        return $this->videogame;
    }

    function setVideogame($videogame) {
        $this->videogame = $videogame;
    }

}
