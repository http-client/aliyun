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
    ];

    public function project($name)
    {
        $parsed = parse_url($this->config['http']['base_uri']);

        $baseUri = sprintf('%s://%s', $parsed['scheme'], $name.'.'.$parsed['host']);

        return new Project\Application(array_merge($this->config, [
            'bucket' => $name,
            'http' => [
                'base_uri' => $baseUri,
            ],
        ]));
    }
}
