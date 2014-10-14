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
        $colecao = array('jornais' => 'Jornais'
        ,'revistas' => 'Revistas'
        ,'tv' => 'TVs'
        ,'radios' => 'Rádios'
        ,'sites' => 'Sites'
        ,'fotografias' => 'Fotografias'
        ,'ilustracoes' => 'Ilustrações'
        ,'artigosacademicos' => 'Artigos Acadêmicos'
        ,'teses' => 'Teses'
        ,'tccs' => 'TCCs'
        ,'musicas' => 'Músicas'
        ,'videos' => 'Vídeos'
        ,'filmes' => 'Filmes'
        ,'documentarios' => 'Documentários'
        ,'livros' => 'Livros'
        ,'depoimentos' => 'Depoimentos'
        ,'outros' => 'Outros');

        $statement_category = array('jornalistas' => 'Jornalistas'
        ,'revistas' => 'Sindicalistas'
        ,'tvs' => 'Trabalhadores'
        ,'radios' => 'Observadores'
        ,'sites' => 'Empregadores'
        ,'fotografias' => 'Autoridades'
        );

        $builder
            ->add('acervo_id', 'text', array('label' => 'ID'))
            ->add('title', 'text', array('label' => 'Título'))
            ->add('subtitle', 'text', array('label' => 'Sub-Título'))
            ->add('category', 'choice', array('choices' => $colecao, 'multiple' => false, 'expanded' => false,
                'label' => 'Categoria do Depoimento'))
            ->add('author', 'text', array('label' => 'Autor'))
            ->add('statement_category', 'choice', array('choices' => $statement_category, 'multiple' => false, 'expanded' => false,
                'label' => 'Coleção'))
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
