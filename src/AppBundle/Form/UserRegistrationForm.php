<?php

namespace AppBundle\Form;

use AppBundle\Entity\UserMgr\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationForm extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('username', TextType::class, [
        'label' => 'User name: ',
        'attr' => ['class' => 'form-control  '],
      ])
      ->add('email', EmailType::class, [
        'label' => 'Email: ',
        'attr' => ['class' => 'form-control  '],
      ])
      ->add('plainPassword', RepeatedType::class, [
        'type' => PasswordType::class,
        'label' => 'Contraseña: ',
        'attr' => ['class' => 'form-control '],
      ])
      ->add('roles', ChoiceType::class, [
        'choices' => ['Developer' => 'ROLE_USER_DEVELOPER', 'Reviewer' => 'ROLE_USER_REVIEWER'], 'data' => '2', 'expanded' => true, 'multiple' => false
      ]) ;

  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => User::class,
      'validation_groups' => ['Default', 'Registration'],
    ]);
  }
}
