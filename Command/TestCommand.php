<?php

namespace Ekyna\Bundle\DemoBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestCommand
 * @package Ekyna\Bundle\DemoBundle\Command
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ekyna:test')
            ->setDescription('Test command.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cacheManager = $this->getContainer()->get('fos_http_cache.cache_manager');

        $cacheManager
            ->invalidateTags(array('demo_test.home[id:2]', 'test-part-one', 'test-part-two'))
            ->flush()
        ;
    }
}
