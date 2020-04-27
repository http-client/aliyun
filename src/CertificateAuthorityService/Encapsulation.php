<?php



namespace HttpClient\Aliyun\CertificateAuthorityService;

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
        $this->config = $config;
        $this->client = $client->setBaseUri('https://cas.aliyuncs.com');
    }

    public function request(array $params)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2018-07-13',
            'AccessKeyId' => $this->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random(),
            // 'ResourceOwnerAccount' => null,
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->config['access_key_secret']);

        return $this->client->request('POST', '/', compact('query'));
    }

    // public function request20180813(array $params)
    // {
    //     return $this->request(array_merge($params, [
    //         'Version' => '2018-08-13',
    //     ]));
    // }
}
