<?php

namespace Ekyna\Bundle\AgendaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Ekyna\Bundle\AgendaBundle\DependencyInjection
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
        $rootNode = $treeBuilder->root('ekyna_agenda');

        $rootNode
            ->children()
                ->scalarNode('output_dir')->defaultValue('')->end()
                ->arrayNode('admin')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('calendar')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end()
        ;

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
                        ->arrayNode('event')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('templates')->defaultValue(array(
                                    '_form.html' => 'EkynaAgendaBundle:Admin/Event:_form.html',
                                    'show.html'  => 'EkynaAgendaBundle:Admin/Event:show.html',
                                    'list.html'  => 'EkynaAgendaBundle:Admin/Event:list.html',
                                ))->end()
                                ->scalarNode('parent')->end()
                                ->scalarNode('entity')->defaultValue('Ekyna\Bundle\AgendaBundle\Entity\Event')->end()
                                ->scalarNode('controller')->defaultValue('Ekyna\Bundle\AgendaBundle\Controller\Admin\EventController')->end()
                                ->scalarNode('operator')->end()
                                ->scalarNode('repository')->defaultValue('Ekyna\Bundle\AgendaBundle\Entity\EventRepository')->end()
                                ->scalarNode('form')->defaultValue('Ekyna\Bundle\AgendaBundle\Form\Type\EventType')->end()
                                ->scalarNode('table')->defaultValue('Ekyna\Bundle\AgendaBundle\Table\Type\EventType')->end()
                                ->scalarNode('event')->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('entity')->defaultValue('Ekyna\Bundle\AgendaBundle\Entity\EventTranslation')->end()
                                        ->scalarNode('repository')->end()
                                        ->arrayNode('fields')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array('title', 'description', 'slug'))
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
