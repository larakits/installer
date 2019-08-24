<?php

namespace Larakits\Installer\Console\Installation;

use Symfony\Component\Process\Process;

class UpdateComposer extends Base
{
    /**
     * Updating composer.
     *
     * @return void
     */
    public function install()
    {
        $this->command->output->writeln('<info>Updating Composer...</info>');
        $this->command->output->newLine();

        $process = new Process("cd $this->path && composer update");

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
