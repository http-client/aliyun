<?php



namespace HttpClient\Aliyun\KeyValueStore;

class Zone extends Definition
{
    public function list()
    {
        return $this->request([
            'Action' => 'DescribeZones',
        ]);
    }
}
