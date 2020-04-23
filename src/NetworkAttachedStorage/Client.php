<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

use HttpClient\Aliyun\Signature\RpcSignature;
use HttpClient\Client as BaseClient;
use function HttpClient\str_random;

class Client extends BaseClient
{
    public function request(array $query)
    {
        $query = array_merge([
            'Format' => 'JSON',
            'Version' => '2017-06-26',
            'AccessKeyId' => $this->app->config['access_key_id'],
            'SignatureMethod' => 'HMAC-SHA1',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => '1.0',
            'SignatureNonce' => str_random(),
        ], $query);

        $query['Signature'] = RpcSignature::sign($query, $this->app->config['access_key_secret']);

        return $this->request('POST', '/', compact('query'));
    }
}
