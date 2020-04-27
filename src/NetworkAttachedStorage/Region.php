<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

class Region extends Encapsulation
{
    public function list()
    {
        return $this->request([
            'Action' => 'DescribeRegions',
        ]);
    }
}
