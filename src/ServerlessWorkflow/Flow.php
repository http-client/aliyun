<?php

namespace HttpClient\Aliyun\ServerlessWorkflow;

class Flow extends Encapsulation
{
    public function create(array $params)
    {
        return $this->request([
            'Action' => 'CreateFlow',
        ] + $params);
    }

    public function get($name)
    {
        return $this->request([
            'Action' => 'DescribeFlow',
            'Name' => $name,
        ]);
    }

    public function list(array $params = [])
    {
        return $this->request([
            'Action' => 'ListFlows',
        ] + $params);
    }

    public function update($name, array $params = [])
    {
        return $this->request([
            'Action' => 'UpdateFlow',
            'Name' => $name,
        ] + $params);
    }

    public function delete($name)
    {
        return $this->request([
            'Action' => 'DeleteFlow',
            'Name' => $name,
        ]);
    }
}
