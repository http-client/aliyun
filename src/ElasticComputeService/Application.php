<?php



namespace HttpClient\Aliyun\ElasticComputeService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'security_group' => SecurityGroup::class,
    ];
}
