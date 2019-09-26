<?php

namespace Larakits\Installer\Console\Installation;

class AddLarakitsServiceProvider extends Base
{
    /**
     * Installing Larakits service provider.
     *
     * @return void
     */
    public function install() : void
    {
        $path = "$this->path/config/app.php";

        file_put_contents(
            $path,
            str_replace(
                "        App\Providers\AppServiceProvider::class,",
                "        Larakits\Providers\LarakitsServiceProvider::class,\n        App\Providers\AppServiceProvider::class,",
                file_get_contents($path)
            )
        );
    }
}
