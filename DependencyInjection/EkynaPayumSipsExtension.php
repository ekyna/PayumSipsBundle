<?php

namespace Ekyna\Bundle\PayumSipsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class EkynaPayumSipsExtension
 * @package Ekyna\Bundle\PayumSipsBundle\DependencyInjection
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaPayumSipsExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        // Api Config
        $container->setParameter('ekyna_payum_sips.api_config', $config['api']);

        // Client config
        $clientDefinition = $container->getDefinition('ekyna_payum_sips.client');
        $clientDefinition->replaceArgument(0, $config['client']);

        // Cache warmer config
        $cacheWarmerDefinition = $container->getDefinition('ekyna_payum_sips.cache_warmer.pathfile');
        $cacheWarmerDefinition->replaceArgument(0, $config['pathfile']);
        $cacheWarmerDefinition->replaceArgument(1, $config['client']);
    }
}
