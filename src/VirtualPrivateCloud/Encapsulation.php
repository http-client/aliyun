<?php



namespace HttpClient\Aliyun\VirtualPrivateCloud;

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
        $this->client = $client->setBaseUri('https://vpc.aliyuncs.com');
        $this->config = $config;
    }

    public function request(array $params)
    {
        $query = array_merge([
            'AccessKeyId' => $this->config['access_key_id'],
            'Format' => 'JSON',
            'SignatureMethod' => 'HMAC-SHA1',
            'SignatureNonce' => str_random(),
            'SignatureVersion' => '1.0',
            'Timestamp' => gmdate("Y-m-d\TH:i:s\Z"),
            'Version' => '2016-04-28',
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', compact('query'));
    }
}
