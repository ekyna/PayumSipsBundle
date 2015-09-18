<?php

namespace Ekyna\Component\Sale\Payment;

/**
 * Interface PaymentInterface
 * @package Ekyna\Component\Sale\Payment
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface PaymentInterface extends \ArrayAccess, \IteratorAggregate
{
    /**
     * Returns the identifier.
     *
     * @return integer
     */
    public function getId();

    /**
     * Sets the method.
     *
     * @param MethodInterface $gateway
     * @return PaymentInterface|$this
     */
    public function setMethod(MethodInterface $gateway);

    /**
     * Returns the method.
     *
     * @return MethodInterface
     */
    public function getMethod();

    /**
     * Sets the amount.
     *
     * @param float $amount
     * @return PaymentInterface|$this
     */
    public function setAmount($amount);

    /**
     * Returns the amount.
     * @return float
     */
    public function getAmount();

    /**
     * Sets the currency code.
     *
     * @param string $currency
     * @return PaymentInterface|$this
     */
    public function setCurrency($currency);

    /**
     * Returns the currency code.
     * 
     * @return string
     */
    public function getCurrency();

    /**
     * Sets the state.
     *
     * @param string $state
     * @return PaymentInterface|$this
     */
    public function setState($state);

    /**
     * Returns the state.
     * 
     * @return string
     */
    public function getState();

    /**
     * Sets the details.
     *
     * @param array|\Traversable $details
     *
     * @return PaymentInterface|$this
     */
    public function setDetails($details);

    /**
     * Returns the details.
     * 
     * @return array
     */
    public function getDetails();

    /**
     * Sets the creation datetime.
     *
     * @param \DateTime $createdAt
     * @return PaymentInterface|$this
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
     * @return PaymentInterface|$this
     */
    public function setUpdatedAt(\DateTime $createdAt = null);

    /**
     * Returns the update datetime.
     * 
     * @return \DateTime
     */
    public function getUpdatedAt();
}
