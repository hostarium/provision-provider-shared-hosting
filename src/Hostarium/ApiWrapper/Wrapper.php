<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\SharedHosting\Hostarium\ApiWrapper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Upmind\ProvisionProviders\SharedHosting\Hostarium\Data\HostariumCredentials;
use Upmind\ProvisionProviders\SharedHosting\Hostarium\ApiWrapper\WrapperException;

/**
 * This provision category contains the common functions used in provisioning
 * flows for accounts/websites on various popular shared hosting platforms.
 */
class Wrapper
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     **/
    protected $apiVersion = 'v1';

    /**
     * @var string
     **/
    protected $siteIp = '34.105.153.101';

    public function __construct(HostariumCredentials $credentials): void
    {
        $this->client = new Client(['base_uri'    => "https://{$credentials->api_url}/reseller/api/{$this->apiVersion}",
                                    'http_errors' => false,
                                    'headers'     => ['Authorization' => 'Bearer ' . $credentials->api_token,        
                                                      'Accept'        => 'application/json'],
                                              ]
                                          );
    }

    /**
     * Return an array of the user's account details
     * 
     * @param int User's account ID
     * 
     * @throws WrapperException On either a connection failure or non-successful response
     * @return array User's account details
     **/
    public function getAccountInfo(int $userId): array
    {
        try
        {
            $response = $this->client->get("/users/{$userId}");
        }
        catch(ConnectException $e)
        {
            throw new WrapperException("Failed to connect to {$credentials->api_url}", 1, $e);
        }

        $json = json_decode($response->getBody(), true);

        // One shouldn't occur without the other but better safe than sorry
        if(!$json['success'] || $response->getStatusCode() !== 200)
        {
            throw new WrapperException("Failed to connect to get user {$userId}", $response->getStatusCode());
        }

        return $json['users'][0];

    }
}
