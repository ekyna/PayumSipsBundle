<?php

namespace Ekyna\Component\Sale\Payment;

/**
 * Class PaymentTransitions
 * @package Ekyna\Component\Sale\Payment
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
final class PaymentTransitions
{
    const TRANSITION_CREATE    = 'create';
    const TRANSITION_PROCESS   = 'process';
    const TRANSITION_CANCEL    = 'cancel';
    const TRANSITION_FAIL      = 'fail';
    const TRANSITION_AUTHORIZE = 'authorize';
    const TRANSITION_COMPLETE  = 'complete';
    const TRANSITION_REFUND    = 'refund';
    const TRANSITION_VOID      = 'void';

    /**
     * Returns the manual transitions.
     *
     * @return array
     */
    static public function getManualTransitions()
    {
        return array(
            PaymentTransitions::TRANSITION_CANCEL,
            PaymentTransitions::TRANSITION_FAIL,
            PaymentTransitions::TRANSITION_AUTHORIZE,
            PaymentTransitions::TRANSITION_COMPLETE,
            PaymentTransitions::TRANSITION_REFUND,
        );
    }
}
