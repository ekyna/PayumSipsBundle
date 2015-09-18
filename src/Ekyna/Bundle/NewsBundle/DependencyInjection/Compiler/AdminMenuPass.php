<?php

namespace Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AdminMenuPass
 * @package Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AdminMenuPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ekyna_admin.menu.pool')) {
            return;
        }

        $pool = $container->getDefinition('ekyna_admin.menu.pool');

        $pool->addMethodCall('createGroup', array(array(
            'name'     => 'content',
            'label'    => 'ekyna_core.field.content',
            'icon'     => 'file',
            'position' => 50,
        )));
        $pool->addMethodCall('createEntry', array('content', array(
            'name'     => 'news',
            'route'    => 'ekyna_news_news_admin_home',
            'label'    => 'ekyna_news.news.label.plural',
            'resource' => 'ekyna_news_news',
            'position' => 10,
        )));
    }
}
