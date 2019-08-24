<?php

namespace Larakits\Installer\Console\Installation;

class UpdateComposerFile extends Base
{
    /**
     * Updating composer.json file.
     *
     * @return void
     */
    public function install()
    {
        $composer = json_decode(file_get_contents(
            "$this->path/composer.json"
        ), true);

        $composer['repositories'] = [[
            'type' => 'path',
            'url' => './larakits',
        ]];

        $composer['require']['larakits/larakits'] = '*';

        file_put_contents(
            "$this->path/composer.json",
            json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}
