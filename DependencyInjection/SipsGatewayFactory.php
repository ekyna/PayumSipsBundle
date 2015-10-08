<?php

namespace Ekyna\Bundle\PayumSipsBundle\DependencyInjection;

use Payum\Bundle\PayumBundle\DependencyInjection\Factory\Gateway\AbstractGatewayFactory;
use Payum\Core\Bridge\Twig\TwigFactory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * Class SipsGatewayFactory
 * @package Ekyna\Bundle\PayumSipsBundle\DependencyInjection
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SipsGatewayFactory extends AbstractGatewayFactory implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'atos_sips';
    }

    /**
     * {@inheritdoc}
     */
    public function addConfiguration(ArrayNodeDefinition $builder)
    {
        parent::addConfiguration($builder);

        $builder
            ->children()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('merchant_id')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('merchant_country')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('pathfile')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.root_dir%/config/sips/param/pathfile')
                        ->end()
                        ->booleanNode('debug')->defaultValue('%kernel.debug%')->end()
                    ->end()
                ->end()
                ->arrayNode('bin')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('request_path')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.root_dir%/config/sips/bin/static/request')
                        ->end()
                        ->scalarNode('response_path')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.root_dir%/config/sips/bin/static/response')
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('default_language')->cannotBeEmpty()->defaultValue('fr')->end()
            ->end();
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('twig', array(
            'paths' => array_flip(array_filter(array(
                'PayumCore' => TwigFactory::guessViewsPath('Payum\Core\Gateway'),
                'PayumSips' => TwigFactory::guessViewsPath('Ekyna\Component\Payum\Sips\SipsGatewayFactory'),
            )))
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function load(ContainerBuilder $container)
    {
        parent::load($container);

        $container->setParameter('payum.sips.template.authorize', '@PayumSips/Action/authorize.html.twig');
    }

    /**
     * @return array
     */
    protected function createFactoryConfig()
    {
        $config = parent::createFactoryConfig();

        $config['payum.template.authorize'] = new Parameter('payum.sips.template.authorize');
        $config['payum.api_default_config'] = new Parameter('payum.sips.api_default_config');

        return $config;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPayumGatewayFactoryClass()
    {
        return 'Ekyna\Component\Payum\Sips\SipsGatewayFactory';
    }

    /**
     * {@inheritDoc}
     */
    protected function getComposerPackage()
    {
        return 'ekyna/payum-sips';
    }
}
