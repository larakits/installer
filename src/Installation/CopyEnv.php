<?php

namespace Larakits\Installer\Console\Installation;

use Symfony\Component\Process\Process;

class CopyEnv extends Base
{
    /**
     * Installing env file.
     *
     * @return void
     */
    public function install() : void
    {
        $process = new Process("cd $this->path && cp .env.example .env");

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
