<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SmartphoneVariant
 */
class SmartphoneVariant
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \Ekyna\Bundle\DemoBundle\Entity\Smartphone
     */
    protected $smartphone;

    /**
     * @var \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariantCharacteristics
     */
    protected $characteristics;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->setCharacteristics(new SmartphoneVariantCharacteristics());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Variant #'.$this->id;
    }

    /**
     * Sets the smartphone.
     *
     * @param \Ekyna\Bundle\DemoBundle\Entity\Smartphone $smartphone
     * @return \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariant
     */
    public function setSmartphone($smartphone = null)
    {
        $this->smartphone = $smartphone;

        return $this;
    }

    /**
     * Returns the smartphone.
     *
     * @return \Ekyna\Bundle\DemoBundle\Entity\Smartphone
     */
    public function getSmartphone()
    {
        return $this->smartphone;
    }

    /**
     * Sets the characteristics
     *
     * @param \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariantCharacteristics $characteristics
     * @return \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariant
     */
    public function setCharacteristics(SmartphoneVariantCharacteristics $characteristics = null)
    {
        $characteristics->setVariant($this);
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * Returns the characteristics.
     *
     * @return \Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariantCharacteristics 
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }
}
