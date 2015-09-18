<?php

namespace Ekyna\Bundle\BlogBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CategoryType
 * @package Ekyna\Bundle\BlogBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('name', 'anchor', array(
                'label' => 'ekyna_core.field.name',
                'sortable' => false,
                'route_name' => 'ekyna_blog_category_admin_show',
                'route_parameters_map' => array(
                    'categoryId' => 'id',
                ),
            ))
            ->addColumn('enabled', 'boolean', array(
                'label' => 'ekyna_core.field.enabled',
                'sortable' => true,
                'route_name' => 'ekyna_blog_category_admin_toggle',
                'route_parameters_map' => array(
                    'categoryId' => 'id',
                ),
            ))
            ->addColumn('createdAt', 'datetime', array(
                'label' => 'ekyna_core.field.created_at',
                'sortable' => false,
            ))
            ->addColumn('actions', 'admin_actions', array(
                'buttons' => array(
                    array(
                        'label' => 'ekyna_core.button.move_up',
                        'icon' => 'arrow-up',
                        'class' => 'primary',
                        'route_name' => 'ekyna_blog_category_admin_move_up',
                        'route_parameters_map' => array(
                            'categoryId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.move_down',
                        'icon' => 'arrow-down',
                        'class' => 'primary',
                        'route_name' => 'ekyna_blog_category_admin_move_down',
                        'route_parameters_map' => array(
                            'categoryId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_blog_category_admin_edit',
                        'route_parameters_map' => array(
                            'categoryId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_blog_category_admin_remove',
                        'route_parameters_map' => array(
                            'categoryId' => 'id'
                        ),
                        'permission' => 'delete',
                    ),
                ),
            ))
            ->addFilter('name', 'text', array(
                'label' => 'ekyna_core.field.name',
            ))
            ->addFilter('enabled', 'boolean', array(
                'label' => 'ekyna_core.field.enabled',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'default_sorts' => array('position asc'),
            'max_per_page' => 100,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_blog_category';
    }
}
