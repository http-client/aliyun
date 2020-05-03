<?php


namespace HttpClient\Aliyun\LogService\Project;

use HttpClient\Aliyun\LogService\Definition;
use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'log' => Log::class,
        // 'logstore' => Logstore::class,
        'index' => Index::class,
    ];
}
