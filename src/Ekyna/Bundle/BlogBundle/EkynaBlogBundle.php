<?php

namespace Ekyna\Bundle\BlogBundle;

use Ekyna\Bundle\BlogBundle\DependencyInjection\Compiler\AdminMenuPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EkynaBlogBundle
 * @package Ekyna\Bundle\BlogBundle
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaBlogBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AdminMenuPass());
    }
}
