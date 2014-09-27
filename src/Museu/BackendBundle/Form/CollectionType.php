<?php

namespace Museu\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CollectionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acervo_id', 'text', array('label' => 'ID'))
            ->add('title', 'text', array('label' => 'Título'))
            ->add('subtitle', 'text', array('label' => 'Sub-Título'))
            ->add('category', 'text', array('label' => 'Coleção'))
            ->add('author', 'text', array('label' => 'Autor'))
            ->add('vehicle', 'text', array('label' => 'Veículo/Instituição'))
            ->add('program', 'text', array('label' => 'Editoria/Programa/Depto'))
            ->add('filename', 'text', array('label' => 'Arquivo do item'))
            ->add('url', 'text', array('label' => 'URL'))
            ->add('acervo_date', 'date', array(
                'label' => 'Data',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'view_timezone' => 'America/Sao_Paulo'))
            ->add('keyword', 'textarea', array('label' => 'Palavras-chaves'))
            ->add('pic', 'text', array('label' => 'Arquivo de imagem (facsimile, capa etc.)'))
            ->add('support_pic', 'text', array('label' => 'Arquivo de imagem de apoio (fotografia, infograma, release etc.)'))
            ->add('support_pic_author', 'text', array('label' => 'Autor da imagem de apoio (fotógrafo, cinegrafista,ilustrador etc.)'))
            ->add('related', 'text', array('label' => 'Itens relacionados'))
            ->add('interpret', 'text', array('label' => 'Intérprete'))
            ->add('body', 'ckeditor', array('config_name' => 'my_config', 'label' => 'Corpo da Notícia'))
 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Museu\BackendBundle\Entity\Collection'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'museu_backendbundle_collection';
    }
}
