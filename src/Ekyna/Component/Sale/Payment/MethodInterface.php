<?php

namespace Ekyna\Component\Sale\Payment;

/**
 * Interface MethodInterface
 * @package Ekyna\Component\Sale\Payment
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface MethodInterface
{
    /**
     * Sets the gateway name.
     *
     * @param string $gatewayName
     * @return MethodInterface|$this
     */
    public function setGatewayName($gatewayName);

    /**
     * Returns the gateway name.
     *
     * @return string
     */
    public function getGatewayName();

    /**
     * Sets the factory name.
     *
     * @param string $name
     * @return MethodInterface|$this
     */
    public function setFactoryName($name);

    /**
     * Returns the factory name.
     *
     * @return string
     */
    public function getFactoryName();

    /**
     * Sets the config.
     *
     * @param array $config
     * @return MethodInterface|$this
     */
    public function setConfig(array $config);

    /**
     * Returns the config.
     *
     * @return array
     */
    public function getConfig();
}
