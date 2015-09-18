<?php

namespace Ekyna\Component\Sale;

/**
 * Class WeightableTrait
 * @package Ekyna\Component\Sale
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
trait WeightableTrait
{
    /**
     * @var float
     */
    protected $weight;

    /**
     * Sets the weight.
     * 
     * @param float $weight
     * 
     * @return \Ekyna\Component\Sale\WeightableInterface|$this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Returns the weight.
     * 
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }
}
