<?php

namespace Larakits\Installer\Console\Installation;

use Symfony\Component\Process\Process;

class CompileAssets extends Base
{
    /**
     * Compiling assets.
     *
     * @return void
     */
    public function install() : void
    {
        if (!$this->command->output->confirm('Want to compile your assets?', true)) {
            return;
        }

        $this->command->output->writeln('<info>Compiling Assets...</info>');

        $process = new Process("cd $this->path && npm run dev --no-progress");

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
