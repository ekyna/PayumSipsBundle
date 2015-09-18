<?php

namespace Ekyna\Bundle\BlogBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class PostType
 * @package Ekyna\Bundle\BlogBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PostType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'ekyna_core.field.title',
                'required' => true,
            ))
            ->add('subTitle', 'text', array(
                'label' => 'ekyna_core.field.subtitle',
                'required' => true,
            ))
            ->add('category', 'ekyna_resource', array(
                'label' => 'ekyna_blog.category.label.singular',
                'class' => 'Ekyna\Bundle\BlogBundle\Entity\Category',
                'allow_list' => true,
                'allow_new'  => true,
                'required' => true,
            ))
            ->add('publishedAt', 'datetime', array(
                'label' => 'ekyna_core.field.published_at',
                'required' => false,
            ))
            ->add('tags', 'ekyna_resource', array(
                'label' => 'ekyna_cms.tag.label.plural',
                'class' => 'Ekyna\Bundle\CmsBundle\Entity\Tag',
                'allow_list' => true,
                'allow_new'  => true,
                'multiple' => true,
                'required' => false,
            ))
            ->add('seo', 'ekyna_cms_seo')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_blog_post';
    }
}
