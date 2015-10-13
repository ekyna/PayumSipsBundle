<?php

namespace Ekyna\Bundle\PayumSipsBundle\DependencyInjection;

use Payum\Bundle\PayumBundle\DependencyInjection\Factory\Gateway\AbstractGatewayFactory;
use Payum\Core\Bridge\Twig\TwigFactory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

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

        $configuration = new Configuration();
        $configuration->addClientSection($builder);
        $configuration->addApiSection($builder);
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

        $container->setParameter('payum.sips.template.capture', '@PayumSips/Action/capture.html.twig');
    }

    /**
     * @return array
     */
    protected function createFactoryConfig()
    {
        $config = parent::createFactoryConfig();

        $config['payum.template.capture'] = new Parameter('payum.sips.template.capture');
        $config['payum.api_config']       = new Parameter('ekyna_payum_sips.api_config');
        $config['payum.client']           = new Reference('ekyna_payum_sips.client');

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
