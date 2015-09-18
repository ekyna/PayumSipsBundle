<?php

namespace Ekyna\Bundle\BlogBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class PostType
 * @package Ekyna\Bundle\BlogBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PostType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('title', 'anchor', array(
                'label' => 'ekyna_core.field.title',
                'sortable' => true,
                'route_name' => 'ekyna_blog_post_admin_show',
                'route_parameters_map' => array(
                    'postId' => 'id'
                ),
            ))
            ->addColumn('category', 'anchor', array(
                'label' => 'ekyna_blog.category.label.singular',
                'sortable' => true,
                'property_path' => 'category.name',
                'route_name' => 'ekyna_blog_category_admin_show',
                'route_parameters_map' => array(
                    'categoryId' => 'category.id'
                ),
            ))
            ->addColumn('publishedAt', 'datetime', array(
                'label' => 'ekyna_core.field.published_at',
                'sortable' => true,
            ))
            ->addColumn('createdAt', 'datetime', array(
                'label' => 'ekyna_core.field.created_at',
                'sortable' => true,
            ))
            ->addColumn('actions', 'admin_actions', array(
                'buttons' => array(
                    array(
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_blog_post_admin_edit',
                        'route_parameters_map' => array(
                            'postId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_blog_post_admin_remove',
                        'route_parameters_map' => array(
                            'postId' => 'id'
                        ),
                        'permission' => 'delete',
                    ),
                ),
            ))
            ->addFilter('title', 'text', array(
                'label' => 'ekyna_core.field.title',
            ))
            ->addFilter('category', 'entity', array(
                'label' => 'ekyna_blog.category.label.singular',
                'class' => 'Ekyna\Bundle\BlogBundle\Entity\Category',
            ))
            ->addFilter('publishedAt', 'datetime', array(
                'label' => 'ekyna_core.field.published_at',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    /*public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'default_sort' => 'position asc',
            'max_per_page' => 100,
        ));
    }*/

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_blog_post';
    }
}
