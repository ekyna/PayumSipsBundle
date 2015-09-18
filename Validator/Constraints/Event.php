<?php

namespace Ekyna\Bundle\AgendaBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Event
 * @package Ekyna\Bundle\AgendaBundle\Validator\Constraints
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Event extends Constraint
{
    public $invalidDateRange = 'ekyna_agenda.event.invalid_date_range';

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
