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
            ->add('name', null, array('label' => 'Название'))
            ->add('desc', null, array('label' => 'Описание'))
            ->add('address', null, array('label' => 'Адрес'))
            ->add('begin', null, array('label' => 'Дата начала'))
            ->add('end', null, array('label' => 'Дата окончания'))
            ->add('places', null, array('label' => 'Количество мест'))
            ->add('price', null, array('label' => 'Стоимость'))
            ->add('x', null, array('label' => 'X'))
            ->add('y', null, array('label' => 'Y'))
            ->add('category', null, array('label' => 'Категории'))
            ->add('base', null, array('label' => 'База отдыха'))
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
