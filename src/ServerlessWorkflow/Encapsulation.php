<?php

namespace HttpClient\Aliyun\ServerlessWorkflow;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client;
use HttpClient\Config\Repository;
use function HttpClient\str_random;

class Encapsulation
{
    /**
     * The http-client instance.
     *
     * @var \HttpClient\Client
     */
    protected $client;

    /**
     * The config repository instance.
     *
     * @var \HttpClient\Config\Repository
     */
    protected $config;

    /**
     * Create a new Encapsulation instance.
     *
     * @param \HttpClient\Client     $client
     * @param \HttpClient\Config\Repository $config
     *
     * @return  void
     */
    public function __construct(Client $client, Repository $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    public function request(array $params = [])
    {
        $params = array_merge([
            'AccessKeyId' => $this->config['access_key_id'],
            'Format' => 'JSON',
            'SignatureVersion' => '1.0',
            'SignatureMethod' => 'HMAC-SHA1',
            'SignatureNonce' => str_random(),
            'Timestamp' => gmdate("Y-m-d\TH:i:s\Z"),
            'Version' => '2019-03-15',
            'SecurityToken' => $this->config['security_token'] ?? null,
        ], $params);

        $params['Signature'] = RpcSignature::sign($params, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', [
            'form_params' => $params,
        ]);
    }
}
