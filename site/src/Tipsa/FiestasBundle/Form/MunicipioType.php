<?php

namespace Tipsa\FiestasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MunicipioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Municipio',null,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Latitud',null,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Longitud',null,array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('departamento',null,array(
                'attr' => array('class' => 'form-control')
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tipsa\FiestasBundle\Entity\Municipio'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tipsa_fiestasbundle_municipio';
    }


}
