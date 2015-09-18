<?php

namespace Ekyna\Bundle\DevBundle\Command;

use Symfony\Component\Console\Command\Command;

/**
 * Class AbstractSubtreeCommand
 * @package Ekyna\Bundle\DevBundle\Command
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractSubtreeCommand extends Command
{
    /**
     * @var array
     */
    private $packages;


    /**
     * Loads the packages configs.
     */
    protected function loadPackages()
    {
        $this->packages = require __DIR__.'/../packages.php';
    }

    /**
     * Returns the packages configurations.
     *
     * @return array
     */
    protected function getPackages()
    {
        return $this->packages;
    }

    /**
     * Returns the package configuration by name.
     *
     * @param string $name
     * @return array
     */
    protected function getPackage($name)
    {
        if (!array_key_exists($name, $this->packages)) {
            throw new \InvalidArgumentException("Package {$name} not found.");
        }

        return $this->packages[$name];
    }
}
