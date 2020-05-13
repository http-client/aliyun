<?php



namespace HttpClient\Aliyun\Redis;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'instance' => Instance::class,
        'zone' => Zone::class,
        'security' => Security::class,
    ];
}
