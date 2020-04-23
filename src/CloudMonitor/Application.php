<?php



namespace HttpClient\Aliyun\CloudMonitor;

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
        'metric' => Metric::class,
    ];
}
