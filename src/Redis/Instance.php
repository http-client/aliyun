<?php



namespace HttpClient\Aliyun\Redis;

class Instance extends Encapsulation
{
    public function create(array $params)
    {
        return $this->request([
            'Action' => 'CreateInstance',
        ] + $params);
    }

    public function get($instanceId)
    {
        return $this->request([
            'Action' => 'DescribeInstanceAttribute',
            'InstanceId' => $instanceId,
        ]);
    }

    public function delete($instanceId)
    {
        return $this->request([
            'Action' => 'DeleteInstance',
            'InstanceId' => $instanceId,
        ]);
    }
}
