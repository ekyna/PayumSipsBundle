<?php

namespace Ekyna\Bundle\NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NewsTranslationType
 * @package AppBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsTranslationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'ekyna_core.field.title',
            ))
            ->add('content', 'tinymce', array(
                'label' => 'ekyna_core.field.content',
                'required' => false,
                'theme' => 'advanced',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'Ekyna\Bundle\NewsBundle\Entity\NewsTranslation',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_news_news_translation';
    }
}
