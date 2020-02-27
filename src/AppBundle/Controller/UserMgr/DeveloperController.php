<?php

namespace AppBundle\Controller\UserMgr;

use AppBundle\Entity\UserMgr\User;
use AppBundle\Entity\UserMgr\Developer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserRegistrationForm;

/**
 * Employeer controller.
 *
 * @Route("developer")
 */
class DeveloperController extends Controller
{
    /**
     * Lists all developer entities.
     *
     * @Route("/", name="developer_index")
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
     * @Route("/new", name="developer_new")
     */
    public function newAction(Request $request)
    {
        $developer = new Developer();

      $form = $this->createForm('AppBundle\Form\UserMgr\DeveloperType', $developer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Set values for the access in user table
            $session = $request->getSession();
            $developer->setUsername($session->get("username"));
            $developer->setPassword($session->get("password"));
            $developer->setEmail($session->get("email"));
            
            $session->set('developerID',$developer->getId());

            $em->persist($developer);
            $em->flush();

          return $this->get('security.authentication.guard_handler')
            ->authenticateUserAndHandleSuccess(
              $developer,
              $request,
              $this->get('app.security.login_form_authenticator'),
              'main'
            );
        }

        return $this->render('usermgr/developer/new.html.twig', array(
            'developer' => $developer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a developer entity.
     *
     * @Route("/{username}", name="developer_show")
     * @Method("GET")
     */
    public function showAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        
        $developer = $em->getRepository(Developer::class)->findOneBy([ 'username' => $username  ]);
        

        return $this->render('usermgr/developer/show.html.twig', array(
            'developer' => $developer,
        ));
    }

    /**
     * Displays a form to edit an existing developer entity
     *
     * @Route("/{username}/edit", name="developer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $username)
    {
        
        $developer = $this->getDoctrine()->getManager()->getRepository(Developer::class)->findOneBy( ['username' => $username] );
        
        $editForm = $this->createForm('AppBundle\Form\UserMgr\DeveloperType', $developer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('developer_show', array('username' => $developer->getUsername()));
        }

        return $this->render('usermgr/developer/edit.html.twig', array(
            'developer' => $developer,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a employeer entity.
     *
     * @Route("/{id}/delete", name="developer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $developer = $em->getRepository(Developer::class)->find($id);
        $form = $this->createDeleteForm($developer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($developer);
            $em->flush();
        }

        return $this->redirectToRoute('developer_index');
    }

    /**
     * Creates a form to delete a employeer entity.
     *
     * @param Developer $developer The developer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Developer $developer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('developer_delete', array('id' => $developer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
