<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Bundle\CoreBundle\Entity\AbstractUpload;

/**
 * Class BrandImage
 * @package Ekyna\Bundle\DemoBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class BrandImage extends AbstractUpload
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Returns the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
