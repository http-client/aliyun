<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The client instances.
     *
     * @var array
     */
    protected $clients = [
        'region' => Region::class,
        'zone' => Zone::class,
        'filesystem' => Filesystem::class,
        'access_group' => AccessGroup::class,
        'access_rule' => AccessRule::class,
        'mount_target' => MountTarget::class,
    ];
}
