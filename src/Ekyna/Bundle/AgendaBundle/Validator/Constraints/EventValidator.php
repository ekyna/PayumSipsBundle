<?php

namespace Ekyna\Bundle\AgendaBundle\Validator\Constraints;

use Ekyna\Bundle\AgendaBundle\Entity\Event as Entity;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class EventValidator
 * @package Ekyna\Bundle\AgendaBundle\Validator\Constraints
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($event, Constraint $constraint)
    {
        if (!$event instanceof Entity) {
            throw new UnexpectedTypeException($event, '\Ekyna\Bundle\AgendaBundle\Entity\Event');
        }
        if (!$constraint instanceof Event) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Survey');
        }

        /**
         * @var Entity $event
         * @var Event $constraint
         */
        if ($event->getStartDate() > $event->getEndDate()) {
            $this->context->addViolationAt('endDate', $constraint->invalidDateRange);
        }
    }
}
