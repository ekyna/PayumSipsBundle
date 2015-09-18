<?php

namespace Ekyna\Bundle\DemoBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Sale\Product\ProductTypes;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class SmartphoneType
 * @package Ekyna\Bundle\DemoBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneType extends ResourceTableType
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
            ->addColumn('name', 'anchor', array(
                'label' => 'ekyna_core.field.name',
                'sortable' => true,
                'route_name' => 'ekyna_demo_smartphone_admin_show',
                'route_parameters_map' => array(
                    'smartphoneId' => 'id'
                ),
            ))
            ->addColumn('category', 'anchor', array(
                'label' => 'ekyna_core.field.category',
                'property_path' => 'category.name',
                'sortable' => false,
                'route_name' => 'ekyna_demo_category_admin_show',
                'route_parameters_map' => array(
                    'categoryId' => 'category.id'
                ),
            ))
            ->addColumn('type', 'choice', array(
                'label' => 'ekyna_core.field.type',
                'sortable' => false,
                'choices' => ProductTypes::getChoices(),
            ))
            ->addColumn('price', 'number', array(
                'label' => 'ekyna_core.field.price',
                'sortable' => true,
            ))
            ->addColumn('actions', 'admin_actions', array(
                'buttons' => array(
                    array(
                        'label' => 'ekyna_core.button.edit',
                        'class' => 'warning',
                        'route_name' => 'ekyna_demo_smartphone_admin_edit',
                        'route_parameters_map' => array(
                            'smartphoneId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.remove',
                        'class' => 'danger',
                        'route_name' => 'ekyna_demo_smartphone_admin_remove',
                        'route_parameters_map' => array(
                            'smartphoneId' => 'id'
                        ),
                        'permission' => 'delete',
                    ),
                ),
            ))
            ->addFilter('id', 'number')
            ->addFilter('name', 'text', array(
            	'label' => 'ekyna_core.field.name'
            ))
            ->addFilter('price', 'number', array(
        	    'label' => 'ekyna_core.field.price'
            ))
            ->addFilter('type', 'choice', array(
        	    'label' => 'ekyna_core.field.type',
                'choices' => ProductTypes::getChoices(),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_demo_smartphone';
    }
}
