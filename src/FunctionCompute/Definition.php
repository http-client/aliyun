<?php



namespace HttpClient\Aliyun\FunctionCompute;

use HttpClient\Aliyun\Signature\AuthorizationSignature;
use HttpClient\Client;
use HttpClient\Config\Repository;

class Definition
{
    protected $client;
    protected $config;

    public function __construct(Client $client, Repository $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Aliyun Function Compute API version.
     *
     * @var string
     */
    protected $apiVersion = '2016-08-15';

    public function request($method, $resource, array $options = [], array $canonicalizedHeaders = [])
    {
        if (isset($this->config['security_token'])) {
            $canonicalizedHeaders = array_merge($canonicalizedHeaders, ['x-fc-security-token' => $this->config['security_token']]);
        }
        $contentMd5 = '';

        $headers = [
            'Date' => $date = gmdate('D, d M Y H:i:s T'),
            'Content-Type' => $contentType = 'application/json',
            // 'Content-Length' => '0',
            // 'Content-MD5' => '',
        ] + $canonicalizedHeaders;

        $signature = AuthorizationSignature::sign($method, $contentMd5, $contentType, $date, $canonicalizedHeaders, $resource, $this->config['access_key_secret'], 'sha256');

        $headers['Authorization'] = sprintf('FC %s:%s', $this->config['access_key_id'], $signature);

        return $this->client->request($method, $resource, array_merge(
            ['headers' => $headers], $options
        ));
    }
}
