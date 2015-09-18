<?php

namespace Ekyna\Component\Sale\Tax;

/**
 * Class Tax
 * @package Ekyna\Component\Sale\Tax
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Tax implements TaxInterface
{
    /**
     * @var float
     */
    protected $rate;

    /**
     * @var string
     */
    protected $name;

    /**
     * Sets the name
     *
     * @param string $name
     * @return Tax
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the rate
     * 
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = floatval($rate);
    }

    /**
     * {@inheritdoc}
     */
    public function getRate()
    {
    	return $this->rate;
    }
}
