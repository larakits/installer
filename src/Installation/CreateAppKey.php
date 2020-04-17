<?php

namespace Larakits\Installer\Console\Installation;

use Symfony\Component\Process\Process;

class CreateAppKey extends Base
{
    /**
     * Creating application key.
     *
     * @return void
     */
    public function install() : void
    {
        $process = Process::fromShellCommandline("cd $this->path && php artisan key:generate --ansi");

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
