<?php

namespace Larakits\Installer\Console\Installation;

use Symfony\Component\Process\Process;

class CreateNewLaravelProject extends Base
{
    /**
     * Creating new Laravel app.
     *
     * @return void
     */
    public function install() : void
    {
        $this->command->output->newLine();
        $this->command->output->writeln('<info>Installing Laravel...</info>');
        $this->command->output->newLine();

        $process = new Process("laravel new {$this->name} --force");

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
