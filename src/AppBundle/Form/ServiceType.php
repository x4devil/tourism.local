<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServiceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', null, array('label' => 'Название'))
                ->add('description', null, array('label' => 'Описание'))
                ->add('price', null, array('label' => 'Стоимость'))
                ->add('bases', null, array('label' => 'Услуга для базы'))
                ->add('x', null, array('label' => 'X'))
                ->add('y', null, array('label' => 'Y'))
                ->add('sublegal', null, array('label' => 'Субподрядчик'))
                ->add('base', null, array('label' => 'База отдыха'))
                ->add('category', null, array('label' => 'Категория'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Service'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_service';
    }

}
