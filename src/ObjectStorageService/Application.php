<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'service' => Service::class,
    ];

    public function bucket($name)
    {
        $parsed = parse_url($this->client->getBaseUri());

        $baseUri = sprintf('%s://%s', $parsed['scheme'], $name.'.'.$parsed['host']);

        return new Bucket\Application(array_merge($this->config->all(), [
            'bucket' => $name,
            'http' => [
                'base_uri' => $baseUri,
            ],
        ]));
    }
}
