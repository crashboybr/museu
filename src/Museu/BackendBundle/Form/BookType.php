<?php

namespace Museu\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Título'))
            ->add('file')
            ->add('author', 'text', array('label' => 'Autor'))
            ->add('description', 'textarea', array('label' => 'Sinopse'))
            ->add('publisher', 'text', array('label' => 'Editora'))
            ->add('url', 'text', array('label' => 'URL'))
            ->add('genre', 'text', array('label' => 'Gênero'))
            ->add('year', 'text', array('label' => 'Ano'))
            ->add('resenha', 'text', array('label' => 'Resenha'))
            ->add('ebook', 'text', array('label' => 'eBook'))
            ->add('next_library', 'text', array('label' => 'Biblioteca Próxima'))
            ->add('library', 'text', array('label' => 'Livraria'))
            ->add('sebo', 'text', array('label' => 'Sebo'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Museu\BackendBundle\Entity\Book'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'museu_backendbundle_book';
    }
}
