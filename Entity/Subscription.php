<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Bundle\ProductBundle\Entity\AbstractOption;

/**
 * Subscription.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Subscription extends AbstractOption
{
    /**
     * @var integer
     */
    protected $duration;

    /**
     * Sets the duration.
     * 
     * @param integer $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * Returns the duration
     */
    public function getDuration()
    {
        return $this->duration;
    }
}
