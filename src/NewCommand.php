<?php

namespace Larakits\Installer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Larakits\Installer\Console\Installation\CopyEnv;
use Symfony\Component\Console\Output\OutputInterface;
use Larakits\Installer\Console\Concerns\Configuration;
use Larakits\Installer\Console\Installation\CreateAppKey;
use Larakits\Installer\Console\Installation\CompileAssets;
use Larakits\Installer\Console\Installation\RunNpmInstall;
use Larakits\Installer\Console\Installation\AddAppProvider;
use Larakits\Installer\Console\Installation\UpdateComposer;
use Larakits\Installer\Console\Installation\DownloadLarakits;
use Larakits\Installer\Console\Installation\RunLarakitsInstall;
use Larakits\Installer\Console\Installation\UpdateComposerFile;
use Larakits\Installer\Console\Installation\CreateNewLaravelProject;
use Larakits\Installer\Console\Installation\AddLarakitsServiceProvider;

class NewCommand extends Command
{
    use Configuration;

    /**
     * Registering command.
     *
     * @return void
     */
    protected function configure() : void
    {
        $this->setName('new')
            ->setDescription('Create a new SaaS project')
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of your SaaS project');
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
        if (!file_exists($this->getConfig())) {
            $output->writeln(['', '<error>Please verify your API token</error>', '']);
            return;
        }

        $name = $input->getArgument('name');
        $path = getcwd() . "/$name";
        $this->output = new SymfonyStyle($input, $output);

        $installers = [
            CreateNewLaravelProject::class,
            CopyEnv::class,
            DownloadLarakits::class,
            UpdateComposerFile::class,
            AddLarakitsServiceProvider::class,
            UpdateComposer::class,
            RunLarakitsInstall::class,
            AddAppProvider::class,
            CreateAppKey::class,
            RunNpmInstall::class,
            CompileAssets::class
        ];

        foreach ($installers as $installer) {
            (new $installer($this, $name, $path))->install();
        }

        $output->writeln(['', "<comment>Congratulations! Larakits setup done. Don't forget to run php artisan migrate</comment>", '']);
    }
}
