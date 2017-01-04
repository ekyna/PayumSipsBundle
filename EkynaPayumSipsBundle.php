<?php

namespace Ekyna\Bundle\PayumSipsBundle;

use Ekyna\Bundle\PayumSipsBundle\DependencyInjection\Compiler\RegisterGatewayPass;
use Ekyna\Component\Payum\Sips\Bridge\Symfony\DependencyInjection\TwigPathCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EkynaPayumSipsBundle
 * @package Ekyna\Bundle\PayumSipsBundle
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaPayumSipsBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigPathCompilerPass);
        $container->addCompilerPass(new RegisterGatewayPass);
    }
}
