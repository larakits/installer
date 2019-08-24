<?php

namespace Larakits\Installer\Console\Installation;

use Symfony\Component\Process\Process;

class RunLarakitsInstall extends Base
{
    /**
     * Installing Larakits.
     *
     * @return void
     */
    public function install() : void
    {
        $this->command->output->newLine();

        $this->command->output->writeln('<info>Installing LARAKITS...</info>');

        $this->command->output->newLine();

        $process = new Process("cd $this->path && php artisan larakits:install");

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
