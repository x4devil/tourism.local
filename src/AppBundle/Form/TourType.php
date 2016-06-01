<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TourType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('desc')
            ->add('address')
            ->add('begin')
            ->add('end')
            ->add('places')
            ->add('empty')
            ->add('price')
            ->add('x')
            ->add('y')
            ->add('category')
            ->add('base')
            ->add('request')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tour'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_tour';
    }
}
