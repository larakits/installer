<?php

namespace Larakits\Installer\Console;

use Exception;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Larakits\Installer\Console\Concerns\Configuration;

class RegisterCommand extends Command
{
    use Configuration;

    /**
     * Registering command.
     *
     * @return void
     */
    protected function configure() : void
    {
        $this->setName('register')
            ->setDescription('Register your larakits API token')
            ->addArgument('token', InputArgument::REQUIRED, 'Larakits API token');
    }

    /**
     * Executing command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $token = $input->getArgument('token');

        try {
            $client = new Client();

            $response = $client->request('POST', LARAKITS_BASE_URL . '/api/verify', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'token' => $token
                ]
            ]);

            $this->writeTokenToConfig($token);

            if ($response->getStatusCode()) {
                $output->writeln(['', '<info> Thanks for registering Larakits</info>', '']);
            }
        } catch (Exception $error) {
            $output->writeln(['', '<error> Please provide a valid API token </error>', '']);
        }

        return 1;
    }
}
