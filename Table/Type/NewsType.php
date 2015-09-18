<?php

namespace Ekyna\Bundle\NewsBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NewsType
 * @package Ekyna\Bundle\NewsBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('name', 'anchor', array(
                'label' => 'ekyna_core.field.name',
                'route_name' => 'ekyna_news_news_admin_show',
                'route_parameters_map' => array(
                    'newsId' => 'id'
                ),
            ))
            ->addColumn('date', 'datetime', array(
                'label' => 'ekyna_core.field.date',
            ))
            ->addColumn('enabled', 'boolean', array(
                'label' => 'ekyna_core.field.enabled',
                'sortable' => true,
                'route_name' => 'ekyna_news_news_admin_toggle',
                'route_parameters_map' => array(
                    'newsId' => 'id',
                ),
            ))
            ->addColumn('actions', 'admin_actions', array(
                'buttons' => array(
                    array(
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_news_news_admin_edit',
                        'route_parameters_map' => array(
                            'newsId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_news_news_admin_remove',
                        'route_parameters_map' => array(
                            'newsId' => 'id'
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
            'default_sorts' => array('date desc'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_news_news';
    }
}
