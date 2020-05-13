<?php

namespace HttpClient\Aliyun\Mail;

class Account extends Encapsulation
{
    public function summary()
    {
        return $this->request([
            'Action' => 'DescAccountSummary',
        ]);
    }
}
