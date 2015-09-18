<?php

namespace Ekyna\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Ekyna\Bundle\BlogBundle\DependencyInjection
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
        $rootNode = $treeBuilder->root('ekyna_blog');

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
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue(array(
                                    '_form.html' => 'EkynaBlogBundle:Admin/Category:_form.html',
                                    'show.html'  => 'EkynaBlogBundle:Admin/Category:show.html',
                                ))->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\BlogBundle\Entity\Category')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\BlogBundle\Controller\Admin\CategoryController')->end()
                                ->scalarNode('operator')->end()
                                ->scalarNode('repository')->defaultValue('Ekyna\Bundle\BlogBundle\Entity\CategoryRepository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\BlogBundle\Form\Type\CategoryType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\BlogBundle\Table\Type\CategoryType')->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('entity')->defaultValue('Ekyna\Bundle\BlogBundle\Entity\CategoryTranslation')->end()
                                        ->scalarNode('repository')->end()
                                        ->arrayNode('fields')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array('name', 'slug'))
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('post')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue(array(
                                    '_form.html' => 'EkynaBlogBundle:Admin/Post:_form.html',
                                    'show.html'  => 'EkynaBlogBundle:Admin/Post:show.html',
                                ))->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\BlogBundle\Entity\Post')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\BlogBundle\Controller\Admin\PostController')->end()
                                ->scalarNode('operator')->end()
                                ->scalarNode('repository')->defaultValue('Ekyna\Bundle\BlogBundle\Entity\PostRepository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\BlogBundle\Form\Type\PostType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\BlogBundle\Table\Type\PostType')->end()
                                // TODO Translation
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
