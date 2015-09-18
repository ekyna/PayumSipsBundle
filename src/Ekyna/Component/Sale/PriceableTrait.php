<?php

namespace Ekyna\Component\Sale;

use Ekyna\Component\Sale\Tax\TaxInterface;
use Ekyna\Component\Sale\Tax\TaxesAmounts;
use Ekyna\Component\Sale\Tax\TaxAmount;

/**
 * Class PriceableTrait
 * @package Ekyna\Component\Sale
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
trait PriceableTrait
{
    /**
     * The base price.
     * 
     * @var float
     */
    protected $price;

    /**
     * The tax.
     * 
     * @var TaxInterface
     */
    protected $tax;

	/**
	 * Sets the base price.
	 * 
     * @param number $price
     * 
     * @return PriceableInterface|$this
     */
    public function setPrice($price)
    {
        $this->price = floatval($price);

        return $this;
    }

	/**
	 * Returns the base price.
	 * 
     * @return number
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the "all taxes excluded" price.
     * 
     * @return float
     */
    public function getNetPrice()
    {
        return $this->getPrice();
    }
    
    /**
     * Returns the "all taxes included" price.
     *
     * @return float
     */
    public function getAtiPrice()
    {
        return $this->getNetPrice() * (1 + $this->tax->getRate());
    }

    /**
     * Returns the tax amount.
     *
     * @return float
     */
    public function getTaxAmount()
    {
        return $this->getAtiPrice() - $this->getNetPrice();
    }

    /**
     * Returns the taxes amounts.
     *
     * @return TaxesAmounts
     */
    public function getTaxesAmounts()
    {
        $amounts = new TaxesAmounts();
        $amounts->addTaxAmount(new TaxAmount($this->tax, $this->getTaxAmount()));
        return $amounts;
    }

	/**
	 * Sets the tax.
	 * 
     * @param TaxInterface $tax
     * 
     * @return PriceableInterface|$this
     */
    public function setTax(TaxInterface $tax)
    {
        $this->tax = $tax;

        return $this;
    }

	/**
	 * Returns the tax.
	 * 
     * @return TaxInterface
     */
    public function getTax()
    {
        return $this->tax;
    }
}
