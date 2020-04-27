<?php

namespace HttpClient\Aliyun\ResourceAccessManagement;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client;
use HttpClient\Config\Repository;

class Definition
{
    protected $config;
    protected $client;

    public function __construct(Repository $config, Client $client)
    {
        $this->config = $config;
        $this->client = $client->setBaseUri('https://ram.aliyuncs.com');
    }

    public function request(array $params)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2015-05-01',
            'SignatureMethod' => 'HMAC-SHA1',
            'SignatureNonce' => \HttpClient\str_random(),
            'SignatureVersion' => '1.0',
            'AccessKeyId' => $this->config['access_key_id'],
            'Timestamp' => gmdate("Y-m-d\TH:i:s\Z"),
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', compact('query'));
    }
}
