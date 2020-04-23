<?php



namespace HttpClient\Aliyun\CloudMonitor;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client;
use HttpClient\Config\Repository;
use function HttpClient\str_random;

class Definition
{
    protected $config;
    protected $client;

    public function __construct(Repository $config, Client $client)
    {
        $this->config = $config;
        $this->client = $client->setBaseUri('https://metrics.aliyuncs.com');
    }

    public function request(array $parameters)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2019-01-01',
            'AccessKeyId' => $this->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random()
        ], $parameters);

        $query['Signature'] = RpcSignature::sign($query, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', compact('query'));
    }
}
