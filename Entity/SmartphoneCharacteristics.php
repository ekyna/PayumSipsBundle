<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Component\Characteristics\Entity\AbstractCharacteristics;
use Ekyna\Component\Characteristics\Annotation as Characteristics;

/**
 * Class SmartphoneCharacteristics
 * @package Ekyna\Bundle\DemoBundle\Entity
 *
 * @Characteristics\Schema("smartphone")
 */
class SmartphoneCharacteristics extends AbstractCharacteristics
{
    /**
     * @var \Ekyna\Bundle\DemoBundle\Entity\Smartphone
     */
    private $smartphone;

    /**
     * @param \Ekyna\Bundle\DemoBundle\Entity\Smartphone $smartphone
     *
     * @return \Ekyna\Bundle\DemoBundle\Entity\SmartphoneCharacteristics
     */
    public function setSmartphone($smartphone)
    {
        $this->smartphone = $smartphone;

        return $this;
    }

    /**
     * @return \Ekyna\Bundle\DemoBundle\Entity\Smartphone
     */
    public function getSmartphone()
    {
        return $this->smartphone;
    }
}
