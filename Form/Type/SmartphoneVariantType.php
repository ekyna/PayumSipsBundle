<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

class SmartphoneVariantType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('characteristics', 'ekyna_characteristics')
        ;
    }

    public function getName()
    {
        return 'ekyna_demo_smartphoneVariant';
    }
}
