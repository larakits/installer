<?php

namespace Larakits\Installer\Console\Concerns;

trait Configuration
{
    /**
     * Get the home path of server.
     *
     * @return string
     */
    protected function homePath() : string
    {
        if (!empty($_SERVER['HOME'])) {
            return $_SERVER['HOME'];
        }

        return $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];
    }

    /**
     * Get configuration directory path.
     *
     * @return string
     */
    protected function getConfigDir() : string
    {
        return $this->homePath() . '/.larakits';
    }

    /**
     * Get the configuration file path.
     *
     * @return string
     */
    protected function getConfig() : string
    {
        return $this->getConfigDir() . '/config.json';
    }

    /**
     * Store the given token in the configuration file.
     *
     * @param string $token
     * @return void
     */
    protected function writeTokenToConfig(string $token) : void
    {
        if (!file_exists($this->getConfigDir())) {
            mkdir($this->getConfigDir());
        }

        file_put_contents(
            $this->getConfig(),
            json_encode(['token' => $token], JSON_PRETTY_PRINT)
        );
    }

    /**
     * Get Larakits API Token.
     *
     * @return string
     */
    protected function getToken() : string
    {
        return json_decode(file_get_contents($this->getConfig()))->token;
    }
}
