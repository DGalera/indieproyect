<?php

namespace AppBundle\Controller\UserMgr;

use AppBundle\Entity\UserMgr\User;
use AppBundle\Entity\UserMgr\Reviewer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserRegistrationForm;

/**
 * Employeer controller.
 *
 * @Route("reviewer")
 */
class ReviewerController extends Controller
{
    /**
     * Lists all developer entities.
     *
     * @Route("/", name="reviewer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $developers = $em->getRepository('AppBundle:UserMgr\Developer')->findAll();

        return $this->render('usermgr/developer/index.html.twig', array(
            'developers' => $developers,
        ));
    }

    /**
     * Creates a new developer entity.
     *
     * @Route("/new", name="reviewer_new")
     */
    public function newAction(Request $request)
    {
        $reviewer = new Reviewer();

      $form = $this->createForm('AppBundle\Form\UserMgr\ReviewerType', $reviewer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Set values for the access in user table
            $session = $request->getSession();
            $reviewer->setUsername($session->get("username"));
            $reviewer->setPassword($session->get("password"));
            $reviewer->setEmail($session->get("email"));
            
            $session->set('reviewerID',$reviewer->getId());

            $em->persist($reviewer);
            $em->flush();

          return $this->get('security.authentication.guard_handler')
            ->authenticateUserAndHandleSuccess(
              $reviewer,
              $request,
              $this->get('app.security.login_form_authenticator'),
              'main'
            );
        }

        return $this->render('usermgr/reviewer/new.html.twig', array(
            'reviewer' => $reviewer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a developer entity.
     *
     * @Route("/{username}", name="reviewer_show")
     * @Method("GET")
     */
    public function showAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        
        $reviewer = $em->getRepository(Reviewer::class)->findOneBy([ 'username' => $username  ]);
        
        return $this->render('usermgr/reviewer/show.html.twig', array(
            'reviewer' => $reviewer,
        ));
    }

    /**
     * Displays a form to edit an existing developer entity.
     *
     * @Route("/{username}/edit", name="reviewer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $username)
    {
        $reviewer = $this->getDoctrine()->getManager()->getRepository(Reviewer::class)->findOneBy( ['username' => $username] );
        
        $editForm = $this->createForm('AppBundle\Form\UserMgr\ReviewerType', $reviewer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reviewer_show', array('username' => $reviewer->getUsername()));
        }

        return $this->render('usermgr/reviewer/edit.html.twig', array(
            'reviewer' => $reviewer,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a employeer entity.
     *
     * @Route("/{id}/delete", name="reviewer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reviewer $reviewer)
    {
        $form = $this->createDeleteForm($reviewer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reviewer);
            $em->flush();
        }

        return $this->redirectToRoute('reviewer_index');
    }

    /**
     * Creates a form to delete a employeer entity.
     *
     * @param Reviewer $reviewer The employeer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reviewer $reviewer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reviewer_delete', array('id' => $reviewer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
