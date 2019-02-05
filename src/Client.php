<?php
namespace Ranium\Fixerio;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * Fixerio HTTP Client class.
 *
 * This class extends GuzzleClient and uses Guzzle's Service Description
 * to make the http requests
 *
 * @author Abbas Ali <abbas@ranium.in>
 */
class Client extends GuzzleClient
{
    /**
     * Method to instantiate the Fixerio web service client
     *
     * @param string  $accessKey Fixer.io access key
     * @param boolean $secure    Whether to send secure request (https)
     * @param array   $config    Extra config options to pass to http client
     *
     * @return Ranium\Fixerio\Client
     */
    public static function create($accessKey, $secure = true, $config = [])
    {

        $baseUrl = ($secure == true ? 'https' : 'http' ) . '://data.fixer.io/';

        // Load the service description file.
        $serviceDescription = new Description(
            ['baseUrl' => $baseUrl] +
            (array) json_decode(file_get_contents(__DIR__ . '/../service.json'), true)
        );

        // Creates the client and sets the default request headers.
        $client = new GuzzleHttpClient(
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]
        );

        // Put the access key as the default parameter for all commands/requests
        $config = $config + ['defaults' => ['access_key' => $accessKey]];

        return new static($client, $serviceDescription, null, null, null, $config);
    }
}
