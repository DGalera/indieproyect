<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserMgr\User;
use AppBundle\Form\UserMgr\DeveloperType;
use AppBundle\Entity\UserMgr\Employeers;
use AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller {

  /**
   * @Route("/register", name="user_register")
   */
  public function registerAction(Request $request, UserPasswordEncoderInterface $encoder) {
    $user_form = new UserRegistrationForm();
    $form = $this->createForm(UserRegistrationForm::class);

    $form->handleRequest($request);
    if ($form->isValid()) {
      // Values of the User object shared by FormerStudents and Employeers
      $user_form = $form->getData();

      // Save access values in session
      $session = $request->getSession();
      $session->set('username', $user_form->getUsername());
      $session->set('email', $user_form->getEmail());

      $plainPassword = $user_form->getPassword();
      $encoded = $encoder->encodePassword($user_form, $plainPassword);
      $session->set('password', $encoded);

      // Check user type
      if (in_array("ROLE_USER_DEVELOPER", $user_form->getRoles())) {
        // Show cv creation form
        return $this->redirectToRoute('developer_new', ['request' => $request]);
      }
      else {
        if (in_array("ROLE_USER_REVIEWER", $user_form->getRoles())) {
          // Show employee creation form
          return $this->redirectToRoute('reviewer_new', ['request' => $request]);
        }
      }

      return $this->get('security.authentication.guard_handler')
        ->authenticateUserAndHandleSuccess(
          $user_form,
          $request,
          $this->get('app.security.login_form_authenticator'),
          'main'
        );
    }
    return $this->render('usermgr/register.html.twig', [
      'form' => $form->createView(),
    ]);
  }
}
