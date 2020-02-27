<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Videogame;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $videogames = $this->getDoctrine() 
                ->getRepository(Videogame::class) 
                ->findAll();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array( 
            'videogames' => $videogames, 
            ));
    }
}
