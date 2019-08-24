<?php

namespace Larakits\Installer\Console\Installation;

class AddAppProvider extends Base
{
    /**
     * Installing app service provider.
     *
     * @return void
     */
    public function install() : void
    {
        $path = "$this->path/config/app.php";

        file_put_contents(
            $path,
            str_replace(
                "        App\Providers\RouteServiceProvider::class,",
                "        App\Providers\RouteServiceProvider::class,\n        App\Providers\LarakitsServiceProvider::class,",
                file_get_contents($path)
            )
        );
    }
}
