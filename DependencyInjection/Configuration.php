<?php

namespace Ekyna\Bundle\PayumSipsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Ekyna\Bundle\PayumSipsBundle\DependencyInjection
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ekyna_payum_sips');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('merchant_id')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('merchant_country')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('pathfile')
                    ->cannotBeEmpty()
                    ->defaultValue('%kernel.root_dir%/config/sips/param/pathfile')
                ->end()
                ->scalarNode('request_bin')
                    ->cannotBeEmpty()
                    ->defaultValue('%kernel.root_dir%/config/sips/bin/static/request')
                ->end()
                ->scalarNode('response_bin')
                    ->cannotBeEmpty()
                    ->defaultValue('%kernel.root_dir%/config/sips/bin/static/response')
                ->end()
                ->booleanNode('debug')->defaultValue('%kernel.debug%')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
