<?php



namespace HttpClient\Aliyun\Redis;

class Zone extends Encapsulation
{
    public function list()
    {
        return $this->request([
            'Action' => 'DescribeZones',
        ]);
    }
}
