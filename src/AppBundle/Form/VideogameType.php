<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use AppBundle\Entity\UserMgr\Developer;

class VideogameType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', TextType::class, [
                    'label' => 'Videogame Title: ',
                    'attr' => ['class' => 'form-control '],
                ])
                ->add('weburl', UrlType::class, [
                    'label' => 'Web URL: ',
                    'attr' => ['class' => 'form-control '],
                ])
                ->add('logo', TextType::class, [
                    'label' => 'Logo URL: ',
                    'attr' => ['class' => 'form-control '],
                ])
                ->add('description', TextType::class, [
                    'label' => 'Description: ',
                    'attr' => ['class' => 'form-control '],
                ])
                ->add('category', EntityType::class, [
                    'label' => 'Category: ',
                    'class' => Category::class,
                    'attr' => ['class' => 'form-control '],
                ])
                ->add('save', SubmitType::class, array('label' => 'Save', 'attr' => array('class' => 'btn btn-primary')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Videogame'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_videogame';
    }

}
