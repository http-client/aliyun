<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

class Zone extends Client
{
    public function list($region)
    {
        return $this->request([
            'Action' => 'DescribeZones',
            'RegionId' => $region,
        ]);
    }
}
