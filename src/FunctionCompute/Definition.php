<?php



namespace HttpClient\Aliyun\FunctionCompute;

use HttpClient\Aliyun\Signature\AuthorizationSignature;
use HttpClient\Client as BaseClient;

class Definition
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Aliyun Function Compute API version.
     *
     * @var string
     */
    protected $apiVersion = '2016-08-15';

    public function request($method, $resource, array $options = [], array $canonicalizedHeaders = [])
    {
        if (isset($this->app->config['security_token'])) {
            $canonicalizedHeaders = array_merge($canonicalizedHeaders, ['x-fc-security-token' => $this->app->config['security_token']]);
        }
        $contentMd5 = '';

        $headers = [
            'Date' => $date = gmdate('D, d M Y H:i:s T'),
            'Content-Type' => $contentType = 'application/json',
            // 'Content-Length' => '0',
            // 'Content-MD5' => '',
        ] + $canonicalizedHeaders;

        $signature = AuthorizationSignature::sign($method, $contentMd5, $contentType, $date, $canonicalizedHeaders, $resource, $this->app->config['access_key_secret'], 'sha256');

        $headers['Authorization'] = sprintf('FC %s:%s', $this->app->config['access_key_id'], $signature);

        return $this->request($method, $resource, array_merge(
            ['headers' => $headers], $options
        ));
    }
}
