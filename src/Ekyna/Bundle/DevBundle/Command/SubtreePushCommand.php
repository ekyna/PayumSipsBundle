<?php

namespace Ekyna\Bundle\DevBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
            ->addArgument('package', InputArgument::OPTIONAL, 'The package name.')
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

        $package = $input->getArgument('package');
        if ($package) {
            $package = $this->getPackage($package);
        }

        $branch = $input->getOption('branch');
        if ($branch) {
            if (!preg_match('~^[0-9]\.[0-9]{1,2}(\.[0-9]{1,3})$~', $branch)) {
                throw new \InvalidArgumentException("Invalid branch '{$branch}'.");
            }
        } else {
            $branch = 'master';
        }

        /** @var \Symfony\Component\Console\Helper\DialogHelper $dialog */
        $dialog = $this->getHelperSet()->get('dialog');

        // Single package
        if ($package) {
            $output->writeln("Pushing <info>{$package['name']}</info> on branch <info>{$branch}</info>");
            if ($dialog->askConfirmation($output, 'Do you want to continue ?', false)) {
                $this->push($output, $package, $branch);
            }
            return;
        }

        // All packages
        $output->writeln("Pushing <info>all packages</info> on branch <info>{$branch}</info> ...");
        if ($dialog->askConfirmation($output, 'Do you want to continue ?', false)) {
            foreach ($this->getPackages() as $package) {
                $this->push($output, $package, $branch);
            }
        }
    }

    /**
     * Runs the git push command for the given package and branch.
     *
     * @param OutputInterface $output
     * @param array $package
     * @param string $branch
     */
    protected function push(OutputInterface $output, array $package, $branch)
    {
        $cmd = sprintf(
            'git subtree push --prefix=%s --squash %s %s',
            $package['prefix'],
            $package['alias'],
            $branch
        );

        $output->writeln($cmd);
        $output->write(str_pad(' - ' . $package['name'], 50, '.', STR_PAD_RIGHT));

        $success = true;
        // TODO $process = new Process();

        if ($success) {
            $output->writeln(' <info>success</info>');
        } else {
            $output->writeln(' <error>failure</error>');
        }
    }
}
