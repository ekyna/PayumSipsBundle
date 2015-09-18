<?php

namespace Ekyna\Component\Sale\Shipment;

/**
 * Interface ShipmentInterface
 * @package Ekyna\Component\Sale\Shipment
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface ShipmentInterface
{
    /**
     * Sets the state.
     *
     * @param string $state
     * @return ShipmentInterface|$this
     */
    public function setState($state);

    /**
     * Returns the state.
     *
     * @return string
     */
    public function getState();

    /**
     * Sets the method.
     *
     * @param string $method
     * @return ShipmentInterface|$this
     */
    public function setMethod($method);

    /**
     * Returns the method.
     *
     * @return string
     */
    public function getMethod();

    /**
     * Sets the creation datetime.
     *
     * @param \DateTime $createdAt
     * @return ShipmentInterface|$this
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Returns the creation datetime.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Sets the update datetime.
     *
     * @param \DateTime $createdAt
     * @return ShipmentInterface|$this
     */
    public function setUpdatedAt(\DateTime $createdAt = null);

    /**
     * Returns the update datetime.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}
