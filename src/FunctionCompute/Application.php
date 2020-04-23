<?php



namespace HttpClient\Aliyun\FunctionCompute;

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
        'function' => ServiceFunction::class,
        'alias' => Alias::class,
        'trigger' => Trigger::class,
        'version' => Version::class,
        'domain' => Domain::class,
    ];
}
