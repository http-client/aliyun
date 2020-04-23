<?php



namespace HttpClient\Aliyun\KeyValueStore;

class Instance extends Definition
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
