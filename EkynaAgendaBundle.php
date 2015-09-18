<?php

namespace Ekyna\Bundle\AgendaBundle;

use Ekyna\Bundle\AgendaBundle\DependencyInjection\Compiler\AdminMenuPass;
use Ekyna\Bundle\CoreBundle\AbstractBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EkynaAgendaBundle
 * @package Ekyna\Bundle\AgendaBundle
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaAgendaBundle extends AbstractBundle
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
            'Ekyna\Bundle\AgendaBundle\Model\EventInterface' => 'ekyna_agenda.event.class',
        );
    }
}
