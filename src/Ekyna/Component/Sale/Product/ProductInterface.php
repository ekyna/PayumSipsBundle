<?php

namespace Ekyna\Component\Sale\Product;

use Ekyna\Component\Sale\PriceableInterface;
use Ekyna\Component\Sale\ReferenceableInterface;
use Ekyna\Component\Sale\WeightableInterface;

/**
 * Interface ProductInterface
 * @package Ekyna\Component\Sale\Product
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface ProductInterface extends PriceableInterface, ReferenceableInterface, WeightableInterface
{
    /**
     * Returns the id.
     *
     * @return int
     */
    public function getId();

    /**
     * Returns the type.
     * 
     * @return integer
     */
    public function getType();
    
    /**
     * Returns the options
     *
     * @return \Doctrine\Common\Collections\ArrayCollection|OptionInterface[]
     */
    public function getOptions();

    /**
     * Returns whether the product has options or not.
     *
     * @return boolean
     */
    public function hasOptions();

    /**
     * Returns the options's groups.
     * 
     * @return array
     */
    public function getOptionsGroups();
}
