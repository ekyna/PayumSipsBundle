<?php

namespace Ekyna\Bundle\BlogBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CategoryType
 * @package Ekyna\Bundle\BlogBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translationsForms', array(
                'form_type' => new CategoryTranslationType(),
                'label'     => false,
                'attr' => array(
                    'widget_col' => 12,
                ),
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'ekyna_core.field.enabled',
                'required' => false,
                'attr' => array(
                    'align_with_widget' => true,
                ),
            ))
            ->add('seo', 'ekyna_cms_seo')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_blog_category';
    }
}
