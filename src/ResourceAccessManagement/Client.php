<?php



namespace HttpClient\Aliyun\ResourceAccessManagement;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client as BaseClient;
use function HttpClient\str_random;

class Client extends BaseClient
{
    /**
     * Base URI of the http client.
     *
     * @var string
     */
    protected $baseUri = 'https://ram.aliyuncs.com';

    public function request(array $params)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2015-05-01',
            'SignatureMethod' => 'HMAC-SHA1',
            'SignatureNonce' => str_random(),
            'SignatureVersion' => '1.0',
            'AccessKeyId' => $this->app->config['access_key_id'],
            'Timestamp' => gmdate("Y-m-d\TH:i:s\Z"),
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->app->config['access_key_secret']);

        return $this->request('POST', '/', compact('query'));
    }
}
