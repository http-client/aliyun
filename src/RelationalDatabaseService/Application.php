<?php



namespace HttpClient\Aliyun\RelationalDatabaseService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The client instances.
     *
     * @var array
     */
    protected $clients = [
        'instance' => Instance::class,
        'database' => Database::class,
        'account' => Account::class,
    ];
}
