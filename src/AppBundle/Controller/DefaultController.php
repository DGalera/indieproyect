<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
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
        $categories = $this->getDoctrine() 
                ->getRepository(Category::class) 
                ->findAll();
        $videogames = $this->getDoctrine() 
                ->getRepository(Videogame::class) 
                ->findAll();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array( 
            'videogames' => $videogames, 
            'categories' => $categories,
            ));
    }
}
