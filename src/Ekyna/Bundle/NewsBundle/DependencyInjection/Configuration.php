<?php

namespace Ekyna\Bundle\NewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Ekyna\Bundle\NewsBundle\DependencyInjection
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
        $rootNode = $treeBuilder->root('ekyna_news');

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
                        ->arrayNode('news')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue(array(
                                    '_form.html' => 'EkynaNewsBundle:Admin/News:_form.html',
                                    'show.html'  => 'EkynaNewsBundle:Admin/News:show.html',
                                ))->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\NewsBundle\Entity\News')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\NewsBundle\Controller\Admin\NewsController')->end()
                                ->scalarNode('operator')->end()
                                ->scalarNode('repository')->defaultValue('Ekyna\Bundle\NewsBundle\Entity\NewsRepository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\NewsBundle\Form\Type\NewsType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\NewsBundle\Table\Type\NewsType')->end()
                                ->scalarNode('event')->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('entity')->defaultValue('Ekyna\Bundle\NewsBundle\Entity\NewsTranslation')->end()
                                        ->scalarNode('repository')->end()
                                        ->arrayNode('fields')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array('title', 'content', 'slug'))
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
