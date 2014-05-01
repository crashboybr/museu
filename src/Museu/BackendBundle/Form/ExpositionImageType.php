<?php

namespace Museu\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExpositionImageType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('pic', 'file', array(
                'attr' => array('multiple' => 'multiple'),
                'label' => false,
                'data_class' => null
                ))
                ->add('author')
                ->add('title')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Museu\BackendBundle\Entity\ExpositionImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'museu_backendbundle_exposition_image';
    }
}
