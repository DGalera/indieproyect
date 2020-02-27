<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('_username',  TextType::class, [
            'label' => 'Nombre de usuario: ',
            'attr' => ['class' => 'form-control'],
          ])
          ->add('_password', PasswordType::class, [
            'label' => 'Contraseña: ',
            'attr' => ['class' => 'form-control'],
          ])
        ;
    }
}
