<?php

namespace HttpClient\Aliyun\Mail;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'account' => Account::class,
    ];

    public function send(array $params)
    {
        return $this->account->request([
            'Action' => 'SingleSendMail',
        ] + $params);
    }
}
