<?php

namespace AppBundle\Form\UserMgr;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewerType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('web', UrlType::class, [
                    'label' => 'Your WebPage: ',
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('name', TextType::class, [
                    'label' => 'Name: ',
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('surnames', TextType::class, [
                    'label' => 'Surnames: ',
                    'attr' => ['class' => 'form-control'],
                ])->add('save', SubmitType::class, array('label' => 'Continue', 'attr' => array('class' => 'btn btn-primary')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\UserMgr\Reviewer',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_usermgr_reviewer';
    }

}
