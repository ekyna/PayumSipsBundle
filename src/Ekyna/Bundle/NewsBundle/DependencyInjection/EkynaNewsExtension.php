<?php

namespace Ekyna\Bundle\NewsBundle\DependencyInjection;

use Ekyna\Bundle\AdminBundle\DependencyInjection\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class EkynaNewsExtension
 * @package Ekyna\Bundle\NewsBundle\DependencyInjection
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaNewsExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->configure($configs, 'ekyna_news', new Configuration(), $container);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        parent::prepend($container);

        $bundles = $container->getParameter('kernel.bundles');

        if (array_key_exists('AsseticBundle', $bundles)) {
            $container->prependExtensionConfig('assetic', array(
                'bundles' => array('EkynaNewsBundle')
            ));
        }
    }
}
