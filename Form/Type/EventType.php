<?php

namespace Ekyna\Bundle\AgendaBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class EventType
 * @package Ekyna\Bundle\AgendaBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translationsForms', array(
                'form_type' => 'ekyna_agenda_event_translation',
                'form_options' => array(
                    'admin_mode' => $options['admin_mode'],
                ),
                'label'     => false,
                'attr' => array(
                    'widget_col' => 12,
                ),
            ))
            ->add('startDate', 'datetime', array(
                'label' => 'ekyna_core.field.start_date',
            ))
            ->add('endDate', 'datetime', array(
                'label' => 'ekyna_core.field.end_date',
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'ekyna_core.field.enabled',
                'required' => false,
                'attr' => array(
                    'align_with_widget' => true,
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_agenda_event';
    }
}
