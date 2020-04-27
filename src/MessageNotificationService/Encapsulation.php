<?php



namespace HttpClient\Aliyun\MessageNotificationService;

use HttpClient\Aliyun\Signature\AuthorizationSignature;
use HttpClient\Client;
use HttpClient\Config\Repository;

class Encapsulation
{
    protected $client;
    protected $config;

    public function __construct(Client $client, Repository $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    public function request(string $method, string $resource, array $options = [])
    {
        $headers = [
            // 'Host' => $this->config['endpoint'],
            'Date' => $date = gmdate('D, d M Y H:i:s T'),
            'Content-Type' => $contentType = 'text/xml',
            // 'Content-Length' => '0',
            'x-mns-version' => '2015-06-06',
        ];

        if (isset($this->config['security_token'])) {
            $headers['security-token'] = $this->config['security_token'];
        }

        $headers['Authorization'] = 'MNS '.$this->config['access_key_id'].':'.AuthorizationSignature::sign($method, '', $contentType, $date, ['x-mns-version' => '2015-06-06'], $resource, $this->config['access_key_secret']);

        // $headers['Authorization'] = 'MNS '.$this->options['access_key_id'].':'.$this->calculateAuthorizationSignature(
        //     $method, '', $contentType, $date, ['x-mns-version' => '2015-06-06'], $resource
        // );

        return $this->client->request($method, $resource, array_merge([
            'headers' => $headers,
        ], $options));
    }
}
