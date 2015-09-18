<?php
namespace Ekyna\Bundle\ShipmentBundle\Event;

use Ekyna\Component\Sale\Shipment\ShipmentInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * ShipmentEvent.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ShipmentEvent extends Event
{
    /**
     * @var \Ekyna\Component\Sale\Shipment\ShipmentInterface
     */
    protected $shipment;

    /**
     * Constructor.
     * 
     * @param \Ekyna\Component\Sale\Shipment\ShipmentInterface $shipment
     */
    public function __construct(ShipmentInterface $shipment)
    {
        $this->shipment = $shipment;
    }

    /**
     * Returns the shipment.
     * 
     * @return \Ekyna\Component\Sale\Shipment\ShipmentInterface
     */
    public function getShipment()
    {
        $this->shipment;
    }
}
