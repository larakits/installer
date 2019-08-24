<?php

namespace Larakits\Installer\Console\Installation;

use Larakits\Installer\Console\NewCommand;

class Base
{
    /**
     * Instance of command.
     *
     * @var \Larakits\Installer\Console\NewCommand
     */
    protected $command;

    /**
     * The name of app.
     *
     * @var string
     */
    protected $name;

    /**
     * The path of app.
     *
     * @var [type]
     */
    protected $path;

    /**
     * Create a new base class instance.
     *
     * @param NewCommand $command
     * @param string $name
     * @param string $path
     */
    public function __construct(NewCommand $command, string $name, string $path)
    {
        $this->command = $command;

        $this->name = $name;

        $this->path = $path;
    }
}
