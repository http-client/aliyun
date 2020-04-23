<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Aliyun\Signature\AuthorizationSignature;
use HttpClient\Client as BaseClient;
use HttpClient\Support\Arr;

class Client extends BaseClient
{
    public function request($method, $resource, array $options = [])
    {
        $options['headers'] = array_merge([
            'Date' => $date = gmdate('D, d M Y H:i:s T'),
            'Content-Type' => $contentType = 'text/plain',
            // 'Content-Length' => '0',
        ], $options['headers'] ?? []);

        $ch = array_filter(Arr::startsWith($options['headers'] ?? [], 'x-oss-'));

        // $headers = array_merge($headers, $ch);

        $options['headers']['Authorization'] = sprintf(
            'OSS %s:%s', $this->app->config['access_key_id'], AuthorizationSignature::sign($method, '', $contentType, $date, $ch, (isset($this->app->config['bucket']) ? '/'.$this->app->config['bucket'] : '').$resource, $this->app->config['access_key_secret'])
        );

        return $this->request($method, $resource, $options);
    }
}
