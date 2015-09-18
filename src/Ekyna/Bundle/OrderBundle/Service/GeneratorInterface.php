<?php

namespace Ekyna\Bundle\OrderBundle\Service;

use Ekyna\Component\Sale\Order\OrderInterface;
use Ekyna\Component\Sale\Order\OrderTypes;

/**
 * Interface GeneratorInterface
 * @package Ekyna\Bundle\OrderBundle\Service
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface GeneratorInterface
{
    /**
     * Returns a unique order number.
     * 
     * @param OrderInterface $order
     * @param string         $type
     * @return GeneratorInterface
     */
    public function generateNumber(OrderInterface $order, $type = OrderTypes::TYPE_ORDER);

    /**
     * Returns a unique order key.
     *
     * @param OrderInterface $order
     * @return GeneratorInterface
     */
    public function generateKey(OrderInterface $order);
}
