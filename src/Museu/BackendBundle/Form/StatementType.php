<?php

namespace Museu\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StatementType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices['apoiadores'] = 'Apoiadores';
        $choices['jornalistas'] = 'Jornalistas';
        $choices['sindicalistas'] = 'Sindicalistas';
        $choices['trabalhadores'] = 'Trabalhadores';
        $choices['patroes'] = 'Jornalistas';
        $choices['policiais'] = 'Policiais';
        $choices['imprensa'] = 'Imprensa';

        $builder
            ->add('name')
            ->add('function', 'text', array('required' => false))
            //->add('text', 'ckeditor', array('config_name' => 'my_config'))
            ->add('text')
            ->add('url', 'text', array('required' => false))
            ->add('type', 'choice', array(
                'choices' => $choices,
                'expanded' => false,
                'data' => '1',
            ))
            ->add('file')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Museu\BackendBundle\Entity\Statement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'museu_backendbundle_statement';
    }
}
