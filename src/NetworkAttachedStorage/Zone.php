<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

class Zone extends Encapsulation
{
    public function list($region)
    {
        return $this->request([
            'Action' => 'DescribeZones',
            'RegionId' => $region,
        ]);
    }
}
