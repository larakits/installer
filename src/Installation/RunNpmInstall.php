<?php

namespace Larakits\Installer\Console\Installation;

use Symfony\Component\Process\Process;

class RunNpmInstall extends Base
{
    /**
     * Installing npm dependencies.
     *
     * @return void
     */
    public function install() : void
    {
        if (!$this->command->output->confirm('Want to install npm dependencies?', true)) {
            return;
        }

        $this->command->output->newLine();

        $this->command->output->writeln('<info>Installing NPM Dependencies...</info>');
        $this->command->output->newLine();

        $process = new Process("cd $this->path && npm install");

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
