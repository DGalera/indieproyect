<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', TextType::class, [
                    'label' => 'Category Name: ',
                    'attr' => ['class' => 'form-control '],
                ])
                ->add('description', TextType::class, [
                    'label' => 'Description: ',
                    'attr' => ['class' => 'form-control '],
                ])
                ->add('save', SubmitType::class, array('label' => 'Save', 'attr' => array('class' => 'btn btn-primary')))
        ;
    }

/**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_category';
    }

}
