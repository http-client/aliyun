<?php

namespace HttpClient\Aliyun\ServerlessWorkflow;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'flow' => Flow::class,
        'execution' => Execution::class,
    ];
}
