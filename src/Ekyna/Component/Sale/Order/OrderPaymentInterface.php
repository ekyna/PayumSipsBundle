<?php

namespace Ekyna\Component\Sale\Order;

use Ekyna\Component\Sale\Payment\PaymentInterface;

/**
 * Interface OrderPaymentInterface
 * @package Ekyna\Component\Sale\Order
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface OrderPaymentInterface extends PaymentInterface
{
    /**
     * Sets the order.
     *
     * @param OrderInterface $order
     *
     * @return OrderPaymentInterface|$this
     */
    public function setOrder(OrderInterface $order = null);

    /**
     * Returns the order.
     * 
     * @return OrderInterface
     */
    public function getOrder();
}
