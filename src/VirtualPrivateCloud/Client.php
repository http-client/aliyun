<?php



namespace HttpClient\Aliyun\VirtualPrivateCloud;

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
    protected $baseUri = 'https://vpc.aliyuncs.com';

    public function request(array $params)
    {
        $query = array_merge([
            'AccessKeyId' => $this->app->config['access_key_id'],
            'Format' => 'JSON',
            'SignatureMethod' => 'HMAC-SHA1',
            'SignatureNonce' => str_random(),
            'SignatureVersion' => '1.0',
            'Timestamp' => gmdate("Y-m-d\TH:i:s\Z"),
            'Version' => '2016-04-28',
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->app->config['access_key_secret']);

        return $this->request('POST', '/', compact('query'));
    }
}
