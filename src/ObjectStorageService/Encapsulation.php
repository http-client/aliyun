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
        $options = $this->encapsulateRequest($method, $resource, $options);

        return $this->client->request($method, $resource, $options);
    }

    protected function requestBucketEndpoint($bucket, $method, $resource, array $options = [])
    {
        $options = $this->encapsulateRequest($method, '/'.$bucket.$resource, $options);
// dd($this->getBucketBaseUri($bucket).$resource);
        return $this->client->request(
            $method,
            $this->getBucketBaseUri($bucket).$resource,
            $options
        );
    }

    protected function encapsulateRequest($method, $resource, array $options = [])
    {
        $options['headers'] = array_merge([
            'Date' => $date = gmdate('D, d M Y H:i:s T'),
            'Content-Type' => $contentType = '',
        ], $options['headers'] ?? []);

        $ch = array_filter(Arr::startsWith($options['headers'] ?? [], 'x-oss-'));

        $options['headers']['Authorization'] = sprintf(
            'OSS %s:%s', $this->config['access_key_id'], AuthorizationSignature::sign($method, '', $contentType, $date, $ch, $resource, $this->config['access_key_secret'])
        );

        return $options;
    }

    /**
     * Get the base uri for the given bucket.
     *
     * @param  string $bucket
     *
     * @return string
     */
    public function getBucketBaseUri($bucket)
    {
        $parsed = parse_url($this->client->getBaseUri());

        return sprintf('%s://%s', $parsed['scheme'], $bucket.'.'.$parsed['host']);
    }
}
