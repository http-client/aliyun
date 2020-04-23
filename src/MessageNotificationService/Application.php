<?php



namespace HttpClient\Aliyun\MessageNotificationService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The client instances.
     *
     * @var array
     */
    protected $clients = [
        'queue' => Queue::class,
        'queue_message' => QueueMessage::class,
    ];
}
