<?php

namespace YourNamespace\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TreeCommand extends Command
{
    // Command name
    protected static $defaultName = 'eloise:tree';

    protected function configure()
    {
        $this
            ->setDescription('This command give us the tree associated with the class given.')
            ->setHelp('You can provide more help or documentation about this command here.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello, this is your custom command!');

        return Command::SUCCESS;
    }
}
