<?php



namespace HttpClient\Aliyun\SecurityTokenService;

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
