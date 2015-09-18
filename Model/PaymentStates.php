<?php

namespace Ekyna\Bundle\PaymentBundle\Model;

use Ekyna\Component\Sale\Payment\PaymentStates as States;
use Ekyna\Bundle\CoreBundle\Model\AbstractConstants;

/**
 * Class PaymentStates
 * @package Ekyna\Bundle\PaymentBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
final class PaymentStates extends AbstractConstants
{
    /**
     * {@inheritdoc}
     */
    static public function getConfig()
    {
        $prefix = 'ekyna_payment.payment.state.';
        $suffix = '.label';
        return array(
            States::STATE_NEW        => array($prefix.States::STATE_NEW.$suffix,        'primary', false),
            States::STATE_PENDING    => array($prefix.States::STATE_PENDING.$suffix,    'warning', false),
            States::STATE_PROCESSING => array($prefix.States::STATE_PROCESSING.$suffix, 'warning', true),
            States::STATE_CANCELLED  => array($prefix.States::STATE_CANCELLED.$suffix,  'default', false),
            States::STATE_FAILED     => array($prefix.States::STATE_FAILED.$suffix,     'danger',  true),
            States::STATE_AUTHORIZED => array($prefix.States::STATE_AUTHORIZED.$suffix, 'success', true),
            States::STATE_COMPLETED  => array($prefix.States::STATE_COMPLETED.$suffix,  'success', true),
            States::STATE_REFUNDED   => array($prefix.States::STATE_REFUNDED.$suffix,   'primary', true),
            States::STATE_UNKNOWN    => array($prefix.States::STATE_UNKNOWN.$suffix,    'default', false),
        );
    }

    /**
     * Returns the theme for the given state.
     *
     * @param string $state
     * @return string
     */
    static public function getTheme($state)
    {
        static::isValid($state, true);

        return static::getConfig()[$state][1];
    }

    /**
     * Returns the notifiable states.
     *
     * @return array
     */
    static public function getNotifiableStates()
    {
        $states = [];
        foreach (static::getConfig() as $state => $config) {
            if ($config[2]) {
                $states[] = $state;
            }
        }
        return $states;
    }
}
