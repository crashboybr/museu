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
        for ($m=1; $m<=12; $m++) {
         $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
         $months[$m] = $month;
         }

        $builder
             ->add('year', 'choice', array(
                'choices' => range(Date('Y') - 50, date('Y')),
                'expanded' => false
            ))
            ->add('month', 'choice', array(
                'choices' => $months,
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
