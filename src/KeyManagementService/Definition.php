<?php



namespace HttpClient\Aliyun\KeyManagementService;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client as BaseClient;

class Definition
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function request(array $params)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2016-01-20',
            'AccessKeyId' => $this->app->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
        ], $params);

        $query['Signature'] = RpcSignature::sign($query, $this->app->config['access_key_secret']);

        return $this->request('POST', '/', [
            'query' => $query,
        ]);
    }
}
