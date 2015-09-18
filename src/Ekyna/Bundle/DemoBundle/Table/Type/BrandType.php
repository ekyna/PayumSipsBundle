<?php

namespace Ekyna\Bundle\DemoBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class BrandType
 * @package Ekyna\Bundle\DemoBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class BrandType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('id', 'number', array(
                'sortable' => true,
            ))
            ->addColumn('title', 'anchor', array(
                'label' => 'ekyna_core.field.title',
                'sortable' => true,
                'route_name' => 'ekyna_demo_brand_admin_show',
                'route_parameters_map' => array(
                    'brandId' => 'id'
                ),
            ))
            ->addColumn('actions', 'admin_actions', array(
                'buttons' => array(
                    array(
                        'label' => 'ekyna_core.button.edit',
                        'class' => 'warning',
                        'route_name' => 'ekyna_demo_brand_admin_edit',
                        'route_parameters_map' => array(
                            'brandId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.remove',
                        'class' => 'danger',
                        'route_name' => 'ekyna_demo_brand_admin_remove',
                        'route_parameters_map' => array(
                            'brandId' => 'id'
                        ),
                        'permission' => 'delete',
                    ),
                ),
            ))
            ->addFilter('id', 'number')
            ->addFilter('title', 'text', array(
            	'label' => 'ekyna_core.field.title'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_demo_brand';
    }
}
