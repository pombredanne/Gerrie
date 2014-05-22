<?php
/**
 * This file is part of the Gerrie package.
 *
 * (c) Andreas Grunwald <andygrunwald@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gerrie\RemoteDataService;

use Gerrie\Process\ProcessFactory;
use Gerrie\RemoteConnector\HTTP as HttpRemoteConnector;
use Gerrie\RemoteConnector\SSH as SshRemoteConnector;

class RemoteDataServiceFactory
{

    public function create($service, array $config)
    {
        $service = strtolower($service);
        switch ($service) {
            case 'http':
                $dataService = $this->createHTTP($config);
                break;
            case 'ssh':
                $dataService = $this->createSSH($config);
                break;
            default:
                $exceptionMessage = 'Service type "%s" not implemented.';
                $exceptionMessage = sprintf($exceptionMessage, $service);
                throw new \Exception($exceptionMessage, 1400783456);
        }

        return $dataService;
    }

    public function createSSH(array $config)
    {
        $host = $config['Host'];
        $port = $config['Port'];
        $username = $config['Username'];
        $keyFile = $config['KeyFile'];

        $executable = '/usr/bin/ssh';

        $processFactory = new ProcessFactory();
        $remoteConnector = new SshRemoteConnector($executable, $processFactory);
        $remoteDataService = new SSH($remoteConnector, $host, $port, $username, $keyFile);

        return $remoteDataService;
    }

    public function createHTTP(array $config)
    {
        $host = $config['Host'];
        $username = $config['Username'];
        $password = $config['Password'];

        // Bootstrap the REST client
        $curlClient = new \Buzz\Client\Curl();
        $curlClient->setVerifyPeer(false);
        $restClient = new \Buzz\Browser($curlClient);

        if ($username && $password) {
            $authListener = new \Buzz\Listener\BasicAuthListener($username, $password);
            $restClient->addListener($authListener);
        }

        $remoteConnector = new HttpRemoteConnector($restClient);
        $remoteDataService = new HTTP($remoteConnector, $host, $username, $password);

        return $remoteDataService;
    }
}