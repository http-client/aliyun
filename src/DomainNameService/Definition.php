<?php



namespace HttpClient\Aliyun\DomainNameService;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client as BaseClient;
use function HttpClient\str_random;

class Definition
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
        $this->app->client->setBaseUri('https://alidns.aliyuncs.com');
    }

    public function request(array $query)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2015-01-09',
            'AccessKeyId' => $this->app->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random()
        ], $query);

        $query['Signature'] = RpcSignature::sign($query, $this->app->config['access_key_secret']);

        return $this->request('POST', '/', compact('query'));
    }
}
