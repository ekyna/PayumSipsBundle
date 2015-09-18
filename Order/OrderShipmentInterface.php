<?php

namespace Ekyna\Component\Sale\Order;

use Ekyna\Component\Sale\Shipment\ShipmentInterface;

/**
 * Interface OrderShipmentInterface
 * @package Ekyna\Component\Sale\Order
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface OrderShipmentInterface extends ShipmentInterface
{
    /**
     * Returns the identifier.
     *
     * @return integer
     */
    public function getId();

    /**
     * Sets the order.
     *
     * @param OrderInterface $order
     *
     * @return OrderShipmentInterface|$this
     */
    public function setOrder(OrderInterface $order = null);

    /**
     * Returns the order.
     *
     * @return OrderInterface
    */
    public function getOrder();
}
