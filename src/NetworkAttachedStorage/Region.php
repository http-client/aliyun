<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

class Region extends Client
{
    public function list()
    {
        return $this->request([
            'Action' => 'DescribeRegions',
        ]);
    }
}
