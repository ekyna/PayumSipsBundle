<?php

namespace Ekyna\Bundle\AgendaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class EventTranslationType
 * @package Ekyna\Bundle\AgendaBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventTranslationType extends AbstractType
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
                'theme' => $options['admin_mode'] ? 'advanced' : 'front',
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
                'data_class' => 'Ekyna\Bundle\AgendaBundle\Entity\EventTranslation',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_agenda_event_translation';
    }
}
