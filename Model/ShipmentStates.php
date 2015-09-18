<?php

namespace Ekyna\Bundle\ShipmentBundle\Model;

use Ekyna\Bundle\CoreBundle\Model\AbstractConstants;
use Ekyna\Component\Sale\Shipment\ShipmentStates as States;

/**
 * Class ShipmentStates
 * @package Ekyna\Bundle\ShipmentBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
final class ShipmentStates extends AbstractConstants
{
    /**
     * {@inheritdoc}
     */
    static public function getConfig()
    {
        $prefix = 'ekyna_shipment.shipment.state.';
        return array(
            States::STATE_CHECKOUT    => array($prefix.States::STATE_CHECKOUT,    'default'),
            States::STATE_ONHOLD      => array($prefix.States::STATE_ONHOLD,      'warning'),
            States::STATE_PENDING     => array($prefix.States::STATE_PENDING,     'warning'),
            States::STATE_BACKORDERED => array($prefix.States::STATE_BACKORDERED, 'warning'),
            States::STATE_READY       => array($prefix.States::STATE_READY,       'success'),
            States::STATE_SHIPPED     => array($prefix.States::STATE_SHIPPED,     'success'),
            States::STATE_COMPLETED   => array($prefix.States::STATE_COMPLETED,   'success'),
            States::STATE_RETURNED    => array($prefix.States::STATE_RETURNED,    'primary'),
            States::STATE_CANCELLED   => array($prefix.States::STATE_CANCELLED,   'default'),
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
}
