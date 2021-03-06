<?php



namespace HttpClient\Aliyun\DomainNameService;

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
        $this->client = $client->setBaseUri('https://alidns.aliyuncs.com');
    }

    public function request(array $query)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2015-01-09',
            'AccessKeyId' => $this->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random()
        ], $query);

        $query['Signature'] = RpcSignature::sign($query, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', compact('query'));
    }
}
