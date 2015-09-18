<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Component\Characteristics\Entity\AbstractCharacteristics;
use Ekyna\Component\Characteristics\Annotation as Characteristics;

/**
 * SmartphoneVariantCharacteristics
 *
 * @Characteristics\Schema("smartphone")
 * @Characteristics\Inherit("variant.smartphone.characteristics")
 */
class SmartphoneVariantCharacteristics extends AbstractCharacteristics
{
    /**
     * @var \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariant
     */
    private $variant;

    /**
     * Set variant
     *
     * @param \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariant $variant
     * @return SmartphoneVariantCharacteristics
     */
    public function setVariant(SmartphoneVariant $variant = null)
    {
        $this->variant = $variant;

        return $this;
    }

    /**
     * Get variant
     *
     * @return \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariant 
     */
    public function getVariant()
    {
        return $this->variant;
    }
}
