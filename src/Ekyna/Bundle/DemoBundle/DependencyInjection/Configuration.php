<?php

namespace Ekyna\Bundle\DemoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class Configuration
 * @package Ekyna\Bundle\DemoBundle\DependencyInjection
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
        $rootNode = $treeBuilder->root('ekyna_demo');

        $this->addPoolsSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds admin pool sections.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addPoolsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('pools')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('category')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue('EkynaDemoBundle:Admin/Category')->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Category')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\DemoBundle\Controller\Admin\CategoryController')->end()
                                ->scalarNode('repository')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\CategoryRepository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\CategoryType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\CategoryType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('brand')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue(array(
                                    '_form.html' => 'EkynaDemoBundle:Admin/Brand:_form.html',
                                    'show.html'  => 'EkynaDemoBundle:Admin/Brand:show.html',
                                ))->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Brand')->end()
                                ->scalarNode('controller')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\BrandType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\BrandType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('smartphone')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue('EkynaDemoBundle:Admin/Smartphone')->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Smartphone')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\DemoBundle\Controller\Admin\SmartphoneController')->end()
                                ->scalarNode('repository')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\SmartphoneRepository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\SmartphoneType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\SmartphoneType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('smartphoneVariant')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue('EkynaDemoBundle:Admin/SmartphoneVariant')->end()
                                ->scalarNode('parent')->defaultValue('ekyna_demo.smartphone')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\SmartphoneVariant')->end()
                                ->scalarNode('controller')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\SmartphoneVariantType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\SmartphoneVariantType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('store')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue(array(
                                    '_form.html' => 'EkynaDemoBundle:Admin/Store:_form.html',
                                    'show.html'  => 'EkynaDemoBundle:Admin/Store:show.html',
                                ))->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\DemoBundle\Entity\Store')->end()
                                ->scalarNode('controller')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\DemoBundle\Form\Type\StoreType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\DemoBundle\Table\Type\StoreType')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
