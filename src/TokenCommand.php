<?php

namespace Larakits\Installer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Larakits\Installer\Console\Concerns\Configuration;

class TokenCommand extends Command
{
    use Configuration;

    /**
     * Registering command.
     *
     * @return void
     */
    protected function configure() : void
    {
        $this->setName('token')
            ->setDescription('Display the registered Larakits API token');
    }

    /**
     * Executing command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln('<info>Larakits API Token: </info>' . $this->getToken());
    }
}
