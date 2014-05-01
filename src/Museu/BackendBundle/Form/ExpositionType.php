<?php

namespace Museu\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExpositionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('date')
            ->add('exposition_images', 'collection', array('type' => new ExpositionImageType(), 'allow_add' => true))
            ->add('exposition_authors', 'collection', array('type' => new ExpositionAuthorType(), 'allow_add' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Museu\BackendBundle\Entity\Exposition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'museu_backendbundle_exposition';
    }
}
