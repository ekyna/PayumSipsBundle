<?php

namespace Ekyna\Bundle\OrderBundle\Provider;

use Ekyna\Component\Sale\Order\OrderItemInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Interface ItemProviderInterface
 * @package Ekyna\Bundle\OrderBundle\Provider
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface ItemProviderInterface
{
    /**
     * Transform the subject to an order item.
     *
     * @param object $subject
     * @return OrderItemInterface
     */
    public function transform($subject);

    /**
     * Returns the subject from the order item.
     *
     * @param OrderItemInterface $item
     * @return object
     */
    public function reverseTransform(OrderItemInterface $item);

    /**
     * Returns the order item form options.
     *
     * @param OrderItemInterface $item
     * @param string             $property
     * @return array
     */
    public function getFormOptions(OrderItemInterface $item, $property);

    /**
     * Generates the front office path for the given subject or order item.
     *
     * @param object $subjectOrOrderItem
     * @return string
     */
    public function generateFrontOfficePath($subjectOrOrderItem);

    /**
     * Generates the back office path for the given subject or order item.
     *
     * @param object $subjectOrOrderItem
     * @return string
     */
    public function generateBackOfficePath($subjectOrOrderItem);

    /**
     * Returns whether the provider supports the given subject or order item.
     *
     * @param object $subjectOrOrderItem
     * @return boolean
     */
    public function supports($subjectOrOrderItem);

    /**
     * Returns the provider name.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets the order item class.
     *
     * @param string $orderItemClass
     * @return AbstractItemProvider
     */
    public function setOrderItemClass($orderItemClass);

    /**
     * Sets the url generator.
     *
     * @param UrlGeneratorInterface $urlGenerator
     * @return AbstractItemProvider
     */
    public function setUrlGenerator(UrlGeneratorInterface $urlGenerator);
}
