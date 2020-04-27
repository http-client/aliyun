<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

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
        $this->client = $client;
        $this->config = $config;
    }

    public function request(array $query)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2017-06-26',
            'AccessKeyId' => $this->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random(),
        ], $query);

        $query['Signature'] = RpcSignature::sign($query, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', compact('query'));
    }
}
