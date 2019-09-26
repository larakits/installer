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
                "        Larakits\Providers\LarakitsServiceProvider::class,",
                "        Laravel\Socialite\SocialiteServiceProvider::class,\n        Larakits\Providers\LarakitsServiceProvider::class,",
                file_get_contents($path)
            )
        );

        file_put_contents(
            $path,
            str_replace(
                "        'View' => Illuminate\Support\Facades\View::class,",
                "        'View' => Illuminate\Support\Facades\View::class,\n        'Socialite' => Laravel\Socialite\Facades\Socialite::class,",
                file_get_contents($path)
            )
        );

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
