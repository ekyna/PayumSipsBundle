<?php

namespace Ekyna\Component\Sale;

/**
 * Interface ReferenceableInterface
 * @package Ekyna\Component\Sale
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface ReferenceableInterface
{
    /**
     * Sets the designation.
     *
     * @param string $designation
     * @return \Ekyna\Component\Sale\ReferenceableInterface|$this
     */
    public function setDesignation($designation);

    /**
     * Returns the designation.
     *
     * @return string
     */
    public function getDesignation();

    /**
     * Sets the reference.
     *
     * @param string $reference
     * @return \Ekyna\Component\Sale\ReferenceableInterface|$this
     */
    public function setReference($reference);

    /**
     * Returns the reference.
     *
     * @return string
     */
    public function getReference();
}
