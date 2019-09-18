<?php

namespace AgoraApi;

use GuzzleHttp\Client;

trait Request
{
    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $customerCertificate;

    /**
     * @var string
     */
    private $baseUri = 'https://api.agora.io';

    /**
     * @param string $customerId
     * @param string $customerCertificate
     */
    public function __construct(string $customerId, string $customerCertificate)
    {
        $this->customerId = $customerId;
        $this->customerCertificate = $customerCertificate;
    }

    /**
     * @param string $baseUri
     * @return void
     */
    public function setBaseUri(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return array
     */
    private function request(string $method = 'get', string $url = '', array $options = []): array
    {
        try {
            $client = new Client([
                'base_uri' => $this->baseUri,
                'timeout' => 20.0,
                'verify' => false
            ]);

            $options = array_merge($options, [
                'auth' => [$this->customerId, $this->customerCertificate]
            ]);

            $response = $client->request($method, $url, $options);

            return [
                'code' => $response->getStatusCode(),
                'data' => (array) json_decode($response->getBody()->getContents(), true)
            ];
        } catch (\Exception $exception) {
            return [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
        }
    }
}
