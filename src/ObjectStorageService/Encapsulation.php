<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Aliyun\Signature\AuthorizationSignature;
use HttpClient\Client;
use HttpClient\Config\Repository;
use HttpClient\Support\Arr;

class Encapsulation
{
    protected $client;
    protected $config;

    public function __construct(Client $client, Repository $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

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
            'OSS %s:%s', $this->config['access_key_id'], AuthorizationSignature::sign($method, '', $contentType, $date, $ch, (isset($this->config['bucket']) ? '/'.$this->config['bucket'] : '').$resource, $this->config['access_key_secret'])
        );

        return $this->client->request($method, $resource, $options);
    }
}
