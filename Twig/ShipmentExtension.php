<?php

namespace Ekyna\Bundle\ShipmentBundle\Twig;

use Ekyna\Bundle\ShipmentBundle\Model\ShipmentStates;
use Ekyna\Component\Sale\Shipment\ShipmentInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class ShipmentExtension
 * @package Ekyna\Bundle\ShipmentBundle\Twig
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ShipmentExtension extends \Twig_Extension
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;


    /**
     * Constructor.
     *
     * @param TranslatorInterface   $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_shipment_state',  array($this, 'getShipmentState'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('render_shipment_state',  array($this, 'renderShipmentState'), array('is_safe' => array('html'))),
        );
    }

    /**
     * Renders the translated shipment state.
     *
     * @param string $state
     * @return string
     */
    public function getShipmentState($state)
    {
        return $this->translator->trans(ShipmentStates::getLabel($state));
    }

    /**
     * Renders the shipment state label.
     *
     * @param string|ShipmentInterface $stateOrShipment
     * @return string
     */
    public function renderShipmentState($stateOrShipment)
    {
        $state = $stateOrShipment instanceof ShipmentInterface ? $stateOrShipment->getState() : $stateOrShipment;
        return sprintf(
            '<span class="label label-%s">%s</span>',
            ShipmentStates::getTheme($state),
            $this->getShipmentState($state)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_shipment';
    }
}
