<?php



namespace HttpClient\Aliyun\RelationalDatabaseService;

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
        'database' => Database::class,
        'account' => Account::class,
    ];
}
