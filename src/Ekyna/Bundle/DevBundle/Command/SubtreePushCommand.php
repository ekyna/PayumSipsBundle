<?php

namespace Ekyna\Bundle\DevBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * Class SubtreePushCommand
 * @package Ekyna\Bundle\DevBundle\Command
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SubtreePushCommand extends AbstractSubtreeCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('git:subtree:push')
            ->setDescription('Git subtree helper.')
            ->addArgument('packages', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, 'The packages names.')
            ->addOption('branch', 'b', InputOption::VALUE_REQUIRED, 'The branch name.')
            ->setHelp(<<<EOT
The <info>git:subtree:push</info> pushes to the subtrees.
EOT
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->loadPackages();

        $packages = (array) $input->getArgument('packages');

        $branch = $input->getOption('branch');
        if ($branch) {
            if (!preg_match('~^[0-9]\.[0-9]{1,2}(\.[0-9]{1,3})?$~', $branch)) {
                throw new \InvalidArgumentException("Invalid branch '{$branch}'.");
            }
        } else {
            $branch = 'master';
        }

        /** @var \Symfony\Component\Console\Helper\DialogHelper $dialog */
        $dialog = $this->getHelperSet()->get('dialog');

        if (empty($packages)) {
            $packages = array_keys($this->getPackages());
            $packagesNames = 'all packages';
        } else {
            $packagesNames = implode(', ', array_map(function($package) {
                return $this->getPackage($package)['name'];
            }, $packages));
        }

        $output->writeln("Pushing <info>{$packagesNames}</info> on branch <info>{$branch}</info>");
        if ($dialog->askConfirmation($output, 'Do you want to continue ?', false)) {
            $this->push($output, $packages, $branch);
        }
    }

    /**
     * Runs the git push command for the given package and branch.
     *
     * @param OutputInterface $output
     * @param array $packages
     * @param string $branch
     */
    protected function push(OutputInterface $output, array $packages, $branch)
    {
        foreach ($packages as $package) {
            $config = $this->getPackage($package);
            $cmd = sprintf(
                'git subtree push --prefix=%s --squash %s %s',
                $config['prefix'],
                $config['alias'],
                $branch
            );

            //$output->writeln($cmd);
            $output->write(str_pad(' - ' . $config['name'], 50, '.', STR_PAD_RIGHT));

            $process = new Process($cmd);
            $process->run();

            if ($process->isSuccessful()) {
                $output->writeln(' <info>success</info>');
            } else {
                $output->writeln(' <error>failure</error>');
            }
        }
    }
}
