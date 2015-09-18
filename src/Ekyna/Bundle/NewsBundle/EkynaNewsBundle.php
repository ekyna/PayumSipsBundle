<?php

namespace Ekyna\Bundle\NewsBundle;

use Ekyna\Bundle\CoreBundle\AbstractBundle;
use Ekyna\Bundle\NewsBundle\DependencyInjection\Compiler\AdminMenuPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EkynaNewsBundle
 * @package Ekyna\Bundle\NewsBundle
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaNewsBundle extends AbstractBundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AdminMenuPass());
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelInterfaces()
    {
        return array(
            'Ekyna\Bundle\NewsBundle\Model\NewsInterface' => 'ekyna_news.news.class',
        );
    }
}
