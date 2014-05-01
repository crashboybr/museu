<?php

namespace Museu\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExpositionAuthorType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('name');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Museu\BackendBundle\Entity\ExpositionAuthor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'museu_backendbundle_exposition_author';
    }
}
