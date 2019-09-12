<?php

namespace Larakits\Installer\Console\Installation;

use ZipArchive;
use GuzzleHttp\Client;
use Larakits\Installer\Console\Concerns\Configuration;

class DownloadLarakits extends Base
{
    use Configuration;

    /**
     * Downloading Larakits from larakits.com.
     *
     * @return void
     */
    public function install() : void
    {
        $this->command->output->newLine();

        $this->command->output->writeln('<info>Downloading LARAKITS...</info>');
        $this->command->output->newLine();

        $config = json_decode(file_get_contents($this->getConfig()));

        $larakitsPath = $this->homePath() . '/.larakits/larakits.zip';

        $response = (new Client)->request('GET', LARAKITS_BASE_URL . '/api/releases/latest/download?api_token=' . $config->token, [
            'headers' => ['Accept' => 'application/json']
        ]);

        file_put_contents($larakitsPath, (string) $response->getBody());

        $zip = new ZipArchive;
        $res = $zip->open($larakitsPath);
        if ($res === true) {
            $zip->extractTo($this->path);
            $zip->close();
            unlink($larakitsPath);
        }
    }
}
