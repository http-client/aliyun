<?php



namespace HttpClient\Aliyun\VirtualPrivateCloud;

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
