<?php

namespace Ekyna\Bundle\PayumSipsBundle;

use Ekyna\Bundle\PayumSipsBundle\DependencyInjection\SipsPaymentFactory;
use Payum\Bundle\PayumBundle\DependencyInjection\PayumExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EkynaPayumSipsBundle
 * @package Ekyna\Bundle\PayumSipsBundle
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaPayumSipsBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        /** @var $extension PayumExtension */
        $extension = $container->getExtension('payum');

        $extension->addPaymentFactory(new SipsPaymentFactory());
    }
}
