<?php

namespace Ekyna\Component\Sale\Order;

use Ekyna\Component\Sale;

/**
 * Interface OrderItemInterface
 * @package Ekyna\Component\Sale\Order
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface OrderItemInterface
{
    /**
     * Sets the designation.
     *
     * @param string $designation
     * @return OrderItemInterface|$this
     */
    public function setDesignation($designation);

    /**
     * Returns the designation.
     *
     * @return string
     */
    public function getDesignation();

    /**
     * Sets the reference.
     *
     * @param string $reference
     * @return OrderItemInterface|$this
     */
    public function setReference($reference);

    /**
     * Returns the reference.
     *
     * @return string
     */
    public function getReference();

    /**
     * Sets the base price.
     *
     * @param number $price
     * @return OrderItemInterface|$this
     */
    public function setPrice($price);

    /**
     * Returns the base price.
     *
     * @return float
     */
    public function getPrice();

    /**
     * Sets the tax.
     *
     * @param Sale\Tax\TaxInterface $tax
     * @return OrderItemInterface|$this
     */
    public function setTax(Sale\Tax\TaxInterface $tax = null);

    /**
     * Returns the tax.
     *
     * @return Sale\Tax\TaxInterface
     */
    public function getTax();

    /**
     * Sets the weight.
     *
     * @param float $weight
     * @return OrderItemInterface|$this
     */
    public function setWeight($weight);

    /**
     * Returns the weight.
     *
     * @return float
     */
    public function getWeight();

    /**
     * Sets the quantity.
     *
     * @param integer $quantity
     * @return OrderItemInterface|$this
     */
    public function setQuantity($quantity);

    /**
     * Returns the quantity.
     *
     * @return integer
     */
    public function getQuantity();

    /**
     * Sets the position.
     *
     * @param integer $position
     * @return OrderItemInterface|$this
     */
    public function setPosition($position);

    /**
     * Returns the position.
     *
     * @return integer
     */
    public function getPosition();

    /**
     * Sets the order.
     *
     * @param OrderInterface $order
     * @return OrderItemInterface|$this
     */
    public function setOrder(OrderInterface $order = null);

    /**
     * Returns the order.
     *
     * @return OrderInterface
     */
    public function getOrder();

    /**
     * Returns whether the current OrderItem equals the given OrderItem or not.
     * 
     * @param OrderItemInterface $orderItem
     * @return boolean
     */
    public function equals(OrderItemInterface $orderItem);

    /**
     * Merges the given OrderItem.
     *
     * @param OrderItemInterface $orderItem
     * @return OrderItemInterface|$this
     */
    public function merge(OrderItemInterface $orderItem);

    /**
     * Sets the subject type.
     *
     * @param string $subjectType
     * @return OrderItemInterface|$this
     */
    public function setSubjectType($subjectType);

    /**
     * Returns the subject type.
     *
     * @return string
     */
    public function getSubjectType();

    /**
     * Sets the subject data.
     *
     * @param array $subjectData
     * @return OrderItemInterface|$this
     */
    public function setSubjectData(array $subjectData);

    /**
     * Returns the subject data.
     *
     * @return array
     */
    public function getSubjectData();

    /**
     * Sets the subject.
     *
     * @param object $subject
     * @return OrderItemInterface|$this
     */
    public function setSubject($subject);

    /**
     * Returns the subject.
     *
     * @return object
     */
    public function getSubject();
}
