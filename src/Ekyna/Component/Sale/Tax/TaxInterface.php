<?php

namespace Ekyna\Component\Sale\Tax;

/**
 * Interface TaxInterface
 * @package Ekyna\Component\Sale\Tax
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface TaxInterface
{
    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the tax rate.
     * 
     * @return float
     */
    public function getRate();
}
