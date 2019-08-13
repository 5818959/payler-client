<?php

namespace Payler\Clients;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use Payler\Exceptions\RequestException;
use Payler\Exceptions\ResponseException;

/**
 * API client.
 */
abstract class Client
{
    /**
     * Base API URL.
     *
     * @var string
     */
    private $baseUrl;

    /**
     * API method name.
     *
     * @var string
     */
    protected $method;

    /**
     * Seller secret key.
     *
     * @var string
     */
    private $key;

    /**
     * Seller password for returns.
     *
     * @var string|null
     */
    private $password;

    /**
     * Constructor.
     *
     * @param string      $baseUrl  Payler API base URL
     * @param string      $key      Seller secret key
     * @param string|null $password Seller password for returns
     */
    public function __construct(string $baseUrl, string $key, $password = null)
    {
        $this->baseUrl = ('/' === substr($baseUrl, -1) ? substr($baseUrl, 0, -1) : $baseUrl) . static::API_URL;
        $this->key = $key;
        $this->password = $password;
    }

    /**
     * Request to API.
     *
     * @param string $method  API method name
     * @param array  $payload Request parameters
     *
     * @return string
     *
     * @throws \Payler\Exceptions\RequestException  Request error
     * @throws \Payler\Exceptions\ResponseException Invalid response
     */
    protected function request(string $method, array $payload = [])
    {
        $payload['key'] = $this->key;

        $client = new GuzzleClient();

        try {
            $response = $client->request('POST', $this->baseUrl . $method, ['form_params' => $payload]);
        } catch (GuzzleRequestException $e) {
            $message = Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                $message .= PHP_EOL . Psr7\str($e->getResponse());
            }

            throw new RequestException($message);
        }

        if (200 != $response->getStatusCode()) {
            throw new ResponseException(
                'Response code is ' . $response->getStatusCode() . PHP_EOL
                . $response->getBody()->getContents()
            );
        }

        return json_decode($response->getBody()->getContents());
    }
}
