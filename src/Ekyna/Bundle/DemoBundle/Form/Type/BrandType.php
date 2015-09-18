<?php

namespace Ekyna\Bundle\DemoBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * BrandType.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class BrandType extends ResourceFormType
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
            ->add('image', 'ekyna_upload', array(
                'label' => 'ekyna_core.field.image',
                'data_class' => 'Ekyna\Bundle\DemoBundle\Entity\BrandImage',
                'js_upload' => false,
                'required' => false
            ))
            ->add('seo', 'ekyna_cms_seo', array(
                'label' => false
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
