<?php

namespace Ekyna\Component\Sale\Tax;

/**
 * Class TaxesAmounts
 * @package Ekyna\Component\Sale\Tax
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class TaxesAmounts implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * @var array|TaxAmount[]
     */
    protected $taxes;

    /**
     * @var float
     */
    protected $total;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->taxes = array();
        $this->total = 0;
    }

    /**
     * Adds a tax amount
     * 
     * @param TaxAmount $taxAmount
     */
    public function addTaxAmount(TaxAmount $taxAmount)
    {
        $this->total += $taxAmount->getAmount();

        foreach ($this->taxes as $tax) {
            if ($tax->getTax() == $taxAmount->getTax()) {
                $tax->addAmount($taxAmount->getAmount());
                return;
            }
        }

        $this->taxes[] = $taxAmount;
    }

    /**
     * Returns the total amount of all taxes.
     * 
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
    
    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
    	return array_key_exists($offset, $this->taxes);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
    	return $this->offsetExists($offset) ? $this->taxes[$offset] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (! $value instanceOf TaxAmount) {
            throw new \InvalidArgumentException('Expected TaxAmount instance.');
        }
        
        $this->taxes[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
    	   unset($this->taxes[$offset]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->taxes);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->taxes);
    }

    /**
     * Merges two TaxesAmounts objects
     * 
     * @param TaxesAmounts $taxesAmounts
     */
    public function merge(TaxesAmounts $taxesAmounts)
    {
        foreach($taxesAmounts as $taxAmount) {
            $this->addTaxAmount($taxAmount);
        }
    }
}
