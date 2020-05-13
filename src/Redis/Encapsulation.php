<?php

namespace HttpClient\Aliyun\Redis;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client;
use HttpClient\Config\Repository;
use function HttpClient\str_random;

class Encapsulation
{
    protected $client;
    protected $config;

    public function __construct(Client $client, Repository $config)
    {
        $this->client = $client->setBaseUri('https://r-kvstore.aliyuncs.com');
        $this->config = $config;
    }

    public function request(array $params)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2015-01-01',
            'AccessKeyId' => $this->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random()
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', compact('query'));
    }
}
