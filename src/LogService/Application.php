<?php



namespace HttpClient\Aliyun\LogService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'project' => Project::class,
        'logstore' => Logstore::class,
        'index' => Index::class,
    ];

    public function getLogProjectBaseUri($name)
    {
        $parsed = parse_url($this->client->getBaseUri());

        return sprintf('%s://%s', $parsed['scheme'], $name.'.'.$parsed['host']);
    }

    public function project($name)
    {
        $parsed = parse_url($this->client->getBaseUri());

        $baseUri = sprintf('%s://%s', $parsed['scheme'], $name.'.'.$parsed['host']);

        return new Project\Application(array_merge($this->config->all(), [
            'bucket' => $name,
            'http' => [
                'base_uri' => $baseUri,
            ],
        ]));
    }
}
