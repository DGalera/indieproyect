<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Review;
use AppBundle\Entity\UserMgr\Reviewer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Videogame;
use Symfony\Component\Security\Core\Security;

/**
 * Review controller.
 *
 * @Route("review")
 */
class ReviewController extends Controller {

    /**
     * Lists all review entities.
     *
     * @Route("/", name="review_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('review/index.html.twig', array(
                    'reviews' => $reviews,
        ));
    }

    /**
     * Creates a new review entity.
     *
     * @Route("/new/{videogameid}", name="review_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $videogameid) {
        $videogame = $this->getDoctrine()
                ->getRepository(Videogame::class)
                ->find($videogameid);

        $review = new Review();
        $review->setVideogame($videogame);

        $loggedin_username = is_null($request->getSession()->get(Security::LAST_USERNAME)) ? $request->getSession()->get('username') : $request->getSession()->get(Security::LAST_USERNAME);
        $reviewer = $this->getDoctrine()->getManager()->getRepository(Reviewer::class)->findOneBy(['username' => $loggedin_username]);
        $review->setReviewer($reviewer);

        $form = $this->createForm('AppBundle\Form\ReviewType', $review);
        $form->handleRequest($request);


        foreach ($videogame->getReviews() as $createdreview) {
            if ($createdreview->getReviewer()->getUsername() == $reviewer->getUsername()) {
                return $this->redirectToRoute('videogame_show', array('id' => $videogameid));
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
        }
        return $this->redirectToRoute('videogame_show', array('id' => $videogameid));
    }

    /**
     * Finds and displays a review entity.
     *
     * @Route("/{id}", name="review_show")
     * @Method("GET")
     */
    public function showAction(Review $review) {
        $deleteForm = $this->createDeleteForm($review);

        return $this->render('review/show.html.twig', array(
                    'review' => $review,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing review entity.
     *
     * @Route("/{id}/edit", name="review_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Review $review) {
        $loggedin_username = is_null($request->getSession()->get(Security::LAST_USERNAME)) ? $request->getSession()->get('username') : $request->getSession()->get(Security::LAST_USERNAME);
        $reviewer = $this->getDoctrine()->getManager()->getRepository(Reviewer::class)->findOneBy(['username' => $loggedin_username]);
        if ($reviewer->getUsername() != $review->getReviewer()->getUsername()) {
            return $this->redirectToRoute('homepage', array('id' => $videogame->getId()));
        }

        $deleteForm = $this->createDeleteForm($review);
        $editForm = $this->createForm('AppBundle\Form\ReviewType', $review);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('videogame_show', array('id' => $review->getVideogame()->getId()));
        }

        return $this->render('review/edit.html.twig', array(
                    'review' => $review,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a review entity.
     *
     * @Route("/{id}/delete", name="review_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Review $review) {
        $form = $this->createDeleteForm($review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($review);
            $em->flush();
        }

        return $this->redirectToRoute('videogame_show', array('id' => $review->getVideogame()->getId()));
    }

    /**
     * Creates a form to delete a review entity.
     *
     * @param Review $review The review entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Review $review) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('review_delete', array('id' => $review->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
