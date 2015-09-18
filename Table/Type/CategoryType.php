<?php

namespace Ekyna\Bundle\DemoBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * CategoryType
 *
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
            ->addColumn('name', 'nested_anchor', array(
                'label' => 'ekyna_core.field.name',
                'route_name' => 'ekyna_demo_category_admin_show',
                'route_parameters_map' => array(
                    'categoryId' => 'id'
                ),
            ))
            ->addColumn('seo.title', 'text', array(
                'label' => 'ekyna_core.field.title',
            ))
            ->addColumn('createdAt', 'datetime', array(
                'label' => 'ekyna_core.field.created_at',
            ))
            ->addColumn('actions', 'admin_nested_actions', array(
                'new_child_route' => 'ekyna_demo_category_admin_new_child',
                'move_up_route' => 'ekyna_demo_category_admin_move_up',
                'move_down_route' => 'ekyna_demo_category_admin_move_down',
                'routes_parameters_map' => array(
                    'categoryId' => 'id'
                ),
                'buttons' => array(
                    array(
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_demo_category_admin_edit',
                        'route_parameters_map' => array(
                            'categoryId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_demo_category_admin_remove',
                        'route_parameters_map' => array(
                            'categoryId' => 'id'
                        ),
                        'permission' => 'delete',
                    ),
                ),
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
            'default_sort' => 'left asc',
            'max_per_page' => 100,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_demo_category';
    }
}
