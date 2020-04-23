<?php



namespace HttpClient\Aliyun\RelationalDatabaseService;

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
    protected $baseUri = 'https://rds.aliyuncs.com';

    public function request(array $params)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2014-08-15',
            'AccessKeyId' => $this->app->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random()
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->app->config['access_key_secret']);

        return $this->request('POST', '/', compact('query'));
    }
}
