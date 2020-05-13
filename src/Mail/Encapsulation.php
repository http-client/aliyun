<?php

namespace HttpClient\Aliyun\Mail;

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
        $this->client = $client->setBaseUri('https://dm.aliyuncs.com');
        $this->config = $config;
    }

    public function request($params)
    {
        $params = array_merge([
            'Format' => 'JSON',
            'Version' => '2015-11-23',
            'AccessKeyId' => $this->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random(),
        ], $params);

        $params['Signature'] = RpcSignature::sign($params, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', ['form_params' => $params]);
    }
}
