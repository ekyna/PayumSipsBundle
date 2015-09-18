<?php

namespace Ekyna\Bundle\CoreBundle\Model;

/**
 * Interface TimestampableInterface
 * @package Ekyna\Bundle\CoreBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface TimestampableInterface
{
    /**
     * Sets the created at datetime.
     *
     * @param \DateTime $createdAt
     * @return TimestampableInterface|$this
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Returns the created at datetime.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set the updated at datetime.
     *
     * @param \DateTime $updatedAt
     * @return TimestampableInterface|$this
     */
    public function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * Returns the updated at datetime.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
} 