<?php

namespace Ekyna\Bundle\SitemapBundle;

use Ekyna\Bundle\SitemapBundle\DependencyInjection\Compiler\SitemapProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EkynaSitemapBundle
 * @package Ekyna\Bundle\SitemapBundle
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaSitemapBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SitemapProviderPass());
    }
}
