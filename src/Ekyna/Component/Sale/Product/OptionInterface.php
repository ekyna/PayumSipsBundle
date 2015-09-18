<?php

namespace Ekyna\Component\Sale\Product;

use Ekyna\Component\Sale\PriceableInterface;
use Ekyna\Component\Sale\ReferenceableInterface;
use Ekyna\Component\Sale\WeightableInterface;

/**
 * Interface OptionInterface
 * @package Ekyna\Component\Sale\Product
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface OptionInterface extends PriceableInterface, ReferenceableInterface, WeightableInterface
{
    /**
     * Returns the id.
     *
     * @return int
     */
    public function getId();

    /**
     * Sets the product.
     *
     * @param ProductInterface $product
     *
     * @return OptionInterface|$this
     */
    public function setProduct(ProductInterface $product = null);

    /**
     * Returns the product.
     *
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * Sets the group.
     *
     * @param string $group
     *
     * @return OptionInterface|$this
     */
    public function setGroup($group);

    /**
     * Returns the group.
     *
     * @return string
     */
    public function getGroup();
}
