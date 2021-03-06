<?php



namespace HttpClient\Aliyun\MessageNotificationService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'queue' => Queue::class,
        'queue_message' => QueueMessage::class,
    ];
}
