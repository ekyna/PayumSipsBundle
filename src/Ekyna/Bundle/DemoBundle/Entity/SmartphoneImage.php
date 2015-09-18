<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Bundle\MediaBundle\Model as Media;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Class SmartphoneImage
 * @package Ekyna\Bundle\DemoBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneImage implements Media\GalleryMediaInterface
{
    use Media\GalleryMediaTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Smartphone
     */
    protected $smartphone;

    /**
     * Returns the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the smartphone.
     *
     * @param Smartphone $smartphone
     * @return SmartphoneImage
     */
    public function setSmartphone(Smartphone $smartphone = null)
    {
        $this->smartphone = $smartphone;
        return $this;
    }

    /**
     * Returns the smartphone.
     *
     * @return Smartphone
     */
    public function getSmartphone()
    {
        return $this->smartphone;
    }
}
