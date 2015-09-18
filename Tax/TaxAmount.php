<?php

namespace Ekyna\Component\Sale\Tax;

/**
 * Class TaxAmount
 * @package Ekyna\Component\Sale\Tax
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class TaxAmount
{
    /**
     * @var TaxInterface
     */
    protected $tax;

    /**
     * @var float
     */
    protected $amount;

    /**
     * Constructor
     * 
     * @param TaxInterface $tax
     * @param $amount
     */
    public function __construct(TaxInterface $tax, $amount = 0)
    {
        $this->tax = $tax;
        $this->amount = $amount;
    }

    /**
     * Returns the tax.
     * 
     * @return \Ekyna\Component\Sale\Tax\TaxInterface
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Returns the tax name.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->tax->getName();
    }

    /**
     * Adds an amount.
     * 
     * @param float $amount
     */
    public function addAmount($amount)
    {
        $this->amount += floatval($amount);
    }

    /**
     * Returns the amount.
     * 
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
