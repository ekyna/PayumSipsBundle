<?php

namespace Ekyna\Bundle\PayumSipsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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

        $root = $treeBuilder->root('ekyna_payum_sips');

        $this->addClientSection($root);
        $this->addPathfileSection($root);

        return $treeBuilder;
    }

    /**
     * Adds the client configuration section.
     *
     * @param ArrayNodeDefinition $node
     */
    public function addClientSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('client')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('merchant_id')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('merchant_country')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('pathfile')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.cache_dir%'.DIRECTORY_SEPARATOR.'ekyna_payum_sips'.DIRECTORY_SEPARATOR.'pathfile')
                        ->end()
                        ->scalarNode('request_bin')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.root_dir%/sips/bin/static/request')
                        ->end()
                        ->scalarNode('response_bin')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.root_dir%/sips/bin/static/response')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * Adds the pathfile configuration section.
     *
     * @param ArrayNodeDefinition $node
     */
    public function addPathfileSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('pathfile')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('debug')
                            ->defaultValue('%kernel.debug%')
                        ->end()
                        ->scalarNode('d_logo')
                            ->defaultValue('bundles/ekynapayumsips/img')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('f_default')
                            ->defaultValue('sips/param/parmcom.scellius')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('f_param')
                            ->defaultValue('sips/param/parmcom')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('f_certificate')
                            ->defaultValue('sips/param/certif')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('f_ctype')
                            ->defaultValue('php')
                            ->cannotBeEmpty()
                            ->validate()
                            ->ifNotInArray(array('php', 'asp'))
                                ->thenInvalid('Invalid f_ctype "%s"')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
