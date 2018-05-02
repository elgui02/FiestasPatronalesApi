<?php

namespace Tipsa\FiestasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FiestaPatronalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre',null,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Descripcion',null,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Fecha', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array('class' => 'form-control')
            ))
            ->add('Latitud',null,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Longitud',null,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('municipio',null,array(
                'attr' => array('class' => 'form-control')
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tipsa\FiestasBundle\Entity\FiestaPatronal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tipsa_fiestasbundle_fiestapatronal';
    }


}
