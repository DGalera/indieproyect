<?php

namespace AppBundle\Repository;

/**
 * VideogameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideogameRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAll() { 
        return $this->getEntityManager() 
                ->createQuery( 
                        "SELECT o FROM AppBundle:Videogame o" 
                        ) 
                ->getResult();      
    }
}