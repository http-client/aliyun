<?php

namespace HttpClient\Aliyun\CertificateAuthorityService;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'user_certificate' => UserCertificate::class,
    ];
}
