<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class RequestService
 * @package App\Services
 */
class RequestService
{

    /**
     * Guzzle client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Response content.
     *
     * @var array
     */
    protected $responseContent;

    /**
     * Class constructor.
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Set the last exception.
     *
     * @param \GuzzleHttp\Psr7\Response $response Guzzle response
     *
     * @return void
     */
    public function setResponseContent(Response $response)
    {
        $this->responseContent = $response;
    }

    public function parse($xml)
    {
        $data = [];
        $simple = new \SimpleXMLElement($xml);

        foreach ($simple->Valute as $row) {
            array_push($data, $row);
        }
        return $data;
    }
    /**
     * Obtain a response content
     *
     * @param bool $json
     * @return array|mixed
     */
    public function obtainResponseContent($xml = true)
    {
        if ($this->responseContent) {
            ini_set('error_reporting', E_ERROR);
            $content = $this->responseContent->getBody()->getContents();

            if (strlen($content) > 1) {
                if ($xml) {
                    return $this->parse($content);
                } else {
                    return $content;
                }
            }
        }

        return [];
    }

    /**
     * @param $url
     * @param array $data
     * @param array $requestHeaders
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function makeGetRequest($url, array $data = [], array $requestHeaders = [])
    {
        return $this->makeRequest('GET', $url, $data, $requestHeaders);
    }

    /**
     * Make a HTTP request
     *
     * @param $method
     * @param $url
     * @param $data
     * @param array $requestHeaders
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function makeRequest($method, $url, $data, array $requestHeaders)
    {
        $defaultHeaders = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json'           => $data,
            'decode_content' => false,
            'http_errors'    => false,
        ];

        $headers  = array_replace_recursive($defaultHeaders, $requestHeaders);
        $response = $this->client->request($method, $url, $headers, $data);

        $this->setResponseContent($response);

        return $this->obtainResponseContent();
    }
}
