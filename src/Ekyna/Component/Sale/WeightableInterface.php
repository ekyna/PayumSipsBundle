<?php

namespace Ekyna\Component\Sale;

/**
 * Interface WeightableInterface
 * @package Ekyna\Component\Sale
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface WeightableInterface
{
    /**
     * Sets the weight.
     *
     * @param float $weight
     *
     * @return \Ekyna\Component\Sale\WeightableInterface|$this
     */
    public function setWeight($weight);

    /**
     * Returns the weight.
     *
     * @return float
     */
    public function getWeight();
}
