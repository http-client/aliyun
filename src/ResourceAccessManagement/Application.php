<?php



namespace HttpClient\Aliyun\ResourceAccessManagement;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The client instances.
     *
     * @var array
     */
    protected $clients = [
        'role' => Role::class,
    ];
}
