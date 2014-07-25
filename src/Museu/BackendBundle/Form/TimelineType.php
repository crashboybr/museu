<?php

namespace Museu\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TimelineType extends AbstractType
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
        
        for ($i = 1950; $i < date('Y'); $i++) {
            $year[$i] = $i;
        }

        $month['1'] = 'Janeiro';
        $month['2'] = 'Fevereiro';
        $month['3'] = 'Março';
        $month['4'] = 'Abril';
        $month['5'] = 'Maio';
        $month['6'] = 'Junho';
        $month['7'] = 'Julho';
        $month['8'] = 'Agosto';
        $month['9'] = 'Setembro';
        $month['10'] = 'Outubro';
        $month['11'] = 'Novembro';
        $month['12'] = 'Dezembro';

        $builder
             ->add('year', 'choice', array(
                'choices' => $year,
                'expanded' => false
            ))
            ->add('month', 'choice', array(
                'choices' => $month,
                'expanded' => false
            ))
            ->add('title')
            ->add('description')
            ->add('file')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Museu\BackendBundle\Entity\Timeline'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'museu_backendbundle_timeline';
    }
}
