<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Bundle\CoreBundle\Entity\AbstractAddress;
use Ekyna\Bundle\CoreBundle\Model as Core;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * Class Store
 * @package Ekyna\Bundle\DemoBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Store
    extends AbstractAddress
    implements Core\TimestampableInterface,
               Core\TaggedEntityInterface
{
    use Core\TimestampableTrait,
        Core\TaggedEntityTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Coordinate
     */
    protected $coordinate;


    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Returns the id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the name.
     *
     * @param string $name
     * @return Store
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the coordinate.
     *
     * @param Coordinate $coordinate
     * @return Store
     */
    public function setCoordinate(Coordinate $coordinate)
    {
        $this->coordinate = $coordinate;
        return $this;
    }

    /**
     * Returns the coordinate.
     *
     * @return Coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * {@inheritdoc}
     */
    public static function getEntityTagPrefix()
    {
        return 'ekyna_demo.store';
    }
}
