<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class StoreType
 * @package Ekyna\Bundle\DemoBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class StoreType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'ekyna_core.field.name',
            ))
            ->add('coordinate', 'ekyna_google_coordinate')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ekyna_address';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_demo_store';
    }
}
