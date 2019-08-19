<?php

namespace Payler\Clients;

use GuzzleHttp\Client as GuzzleClient;
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
    protected $password;

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
            $code = -1;
            $message = $e->getMessage();
            if ($e->hasResponse()) {
                $response = json_decode((string) $e->getResponse()->getBody());
                if (!empty($response)) {
                    $code = $response->error->code;
                    $message = $response->error->message;
                }
            }

            throw new RequestException($message, $code, $e);
        }

        if (200 != $response->getStatusCode()) {
            throw new ResponseException('Bad response HTTP status code: ' . $response->getStatusCode());
        }

        return json_decode($response->getBody()->getContents());
    }
}
