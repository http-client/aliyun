<?php



namespace HttpClient\Aliyun\DomainNameService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'record' => Record::class,
    ];
}
