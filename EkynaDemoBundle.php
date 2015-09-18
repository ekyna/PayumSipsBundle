<?php

namespace Ekyna\Bundle\DemoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ekyna\Bundle\DemoBundle\DependencyInjection\Compiler\AdminMenuPass;

/**
 * Class EkynaDemoBundle
 * @package Ekyna\Bundle\DemoBundle
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaDemoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AdminMenuPass());
    }
}
