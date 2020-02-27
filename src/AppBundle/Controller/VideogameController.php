<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserMgr\Developer;
use AppBundle\Entity\UserMgr\Reviewer;
use AppBundle\Entity\Review;
use AppBundle\Entity\Videogame;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * Videogame controller.
 *
 * @Route("videogame")
 */
class VideogameController extends Controller
{
    /**
     * Lists all videogame entities.
     *
     * @Route("/", name="videogame_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videogames = $em->getRepository('AppBundle:Videogame')->findAll();

        return $this->render('videogame/index.html.twig', array(
            'videogames' => $videogames,
        ));
    }

    /**
     * Creates a new videogame entity.
     *
     * @Route("/new", name="videogame_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $videogame = new Videogame();
        
        $loggedin_username = is_null($request->getSession()->get(Security::LAST_USERNAME))? $request->getSession()->get('username') : $request->getSession()->get(Security::LAST_USERNAME)  ;
        $developer = $this->getDoctrine()->getManager()->getRepository(Developer::class)->findOneBy( ['username' => $loggedin_username] );
        $videogame->setDeveloper($developer);
        
        $form = $this->createForm('AppBundle\Form\VideogameType', $videogame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($videogame);
            $em->flush();

            return $this->redirectToRoute('videogame_show', array('id' => $videogame->getId()));
        }

        return $this->render('videogame/new.html.twig', array(
            'videogame' => $videogame,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a videogame entity.
     *
     * @Route("/{id}", name="videogame_show")
     * @Method({"GET", "POST", "DELETE"})
     */
    public function showAction(Request $request, Videogame $videogame)
    {
        
        $review = new Review();
        $review->setVideogame($videogame);
        
        $loggedin_username = is_null($request->getSession()->get(Security::LAST_USERNAME))? $request->getSession()->get('username') : $request->getSession()->get(Security::LAST_USERNAME)  ;
        $reviewer = $this->getDoctrine()->getManager()->getRepository(Reviewer::class)->findOneBy( ['username' => $loggedin_username] );
        $review->setReviewer($reviewer);
        
        $reviewform = $this->createForm('AppBundle\Form\ReviewType', $review);
        $reviewform->handleRequest($request);
        

        if ($reviewform->isSubmitted() && $reviewform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('videogame_show', array('id' => $videogame->getId()));
        }

        return $this->render('videogame/show.html.twig', array(
            'videogame' => $videogame,
            'form' => $reviewform->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing videogame entity.
     *
     * @Route("/{id}/edit", name="videogame_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Videogame $videogame)
    {   
        $loggedin_username = is_null($request->getSession()->get(Security::LAST_USERNAME))? $request->getSession()->get('username') : $request->getSession()->get(Security::LAST_USERNAME)  ;
        $developer = $this->getDoctrine()->getManager()->getRepository(Developer::class)->findOneBy( ['username' => $loggedin_username] );
        if($developer->getUsername() != $videogame->getDeveloper()->getUsername()){
            return $this->redirectToRoute('videogame_show', array('id' => $videogame->getId()));
        }
        
        $deleteForm = $this->createDeleteForm($videogame);
        $editForm = $this->createForm('AppBundle\Form\VideogameType', $videogame);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('videogame_show', array('id' => $videogame->getId()));
        }

        return $this->render('videogame/edit.html.twig', array(
            'videogame' => $videogame,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a videogame entity.
     *
     * @Route("/{id}/delete", name="videogame_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Videogame $videogame)
    {
        $form = $this->createDeleteForm($videogame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach($videogame->getReviews() as $review){
                $em->remove($review);
            }
            foreach($videogame->getResources() as $resource){
                $em->remove($resource);
            }
            $em->remove($videogame);
            $em->flush();
        }

        return $this->redirectToRoute('videogame_index');
    }

    /**
     * Creates a form to delete a videogame entity.
     *
     * @param Videogame $videogame The videogame entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Videogame $videogame)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('videogame_delete', array('id' => $videogame->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
