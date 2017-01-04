<?php

namespace Ekyna\Bundle\PayumSipsBundle\DependencyInjection\Compiler;

use Ekyna\Component\Payum\Sips\SipsGatewayFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RegisterFactoryClass
 * @package Ekyna\Bundle\PayumSipsBundle\DependencyInjection\Compiler
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class RegisterGatewayPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('payum.builder')) {
            return;
        }

        $defaultConfig = [
            'payum.template.capture' => new Parameter('ekyna_payum_sips.template.capture'),
            'payum.api_config'       => new Parameter('ekyna_payum_sips.api_config'),
            'payum.client'           => new Reference('ekyna_payum_sips.client'),
        ];

        $payumBuilder = $container->getDefinition('payum.builder');
        $payumBuilder->addMethodCall('addGatewayFactoryConfig', ['atos_sips', $defaultConfig]);
        $payumBuilder->addMethodCall('addGatewayFactory', ['atos_sips', [SipsGatewayFactory::class, 'build']]);
    }
}
