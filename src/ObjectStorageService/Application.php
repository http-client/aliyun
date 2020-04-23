<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The client instances.
     *
     * @var array
     */
    protected $clients = [
        'service' => Service::class,
    ];

    public function bucket($name)
    {
        $parsed = parse_url($this->config['http']['base_uri']);

        $baseUri = sprintf('%s://%s', $parsed['scheme'], $name.'.'.$parsed['host']);

        return new BucketApplication(array_merge($this->config, [
            'bucket' => $name,
            'http' => [
                'base_uri' => $baseUri,
            ],
        ]));
    }
}
