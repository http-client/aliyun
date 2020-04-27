<?php



namespace HttpClient\Aliyun\SecurityTokenService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'role' => Role::class,
    ];
}
