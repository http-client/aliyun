<?php



namespace HttpClient\Aliyun\KeyManagementService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'secret' => Secret::class,
    ];
}
