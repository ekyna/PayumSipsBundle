<?php

namespace Ekyna\Bundle\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class SitemapProviderPass
 * @package Ekyna\Bundle\SitemapBundle\DependencyInjection\Compiler
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SitemapProviderPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ekyna_sitemap.provider_registry')) {
            return;
        }

        $definition = $container->getDefinition('ekyna_sitemap.provider_registry');
        $services = $container->findTaggedServiceIds('ekyna_sitemap.provider');

        foreach ($services as $service => $attributes) {
            $definition->addMethodCall('addProvider', array(new Reference($service)));
        }
    }
}
