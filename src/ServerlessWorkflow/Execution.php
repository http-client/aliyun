<?php

namespace HttpClient\Aliyun\ServerlessWorkflow;

class Execution extends Encapsulation
{
    public function get($executionName, $flowName, $wait = null)
    {
        return $this->request([
            'Action' => 'DescribeExecution',
            'ExecutionName' => $executionName,
            'FlowName' => $flowName,
            'WaitTimeSeconds' => $wait,
        ]);
    }

    public function list($flowName, array $params = [])
    {
        return $this->request([
            'Action' => 'ListExecutions',
            'FlowName' => $flowName,
        ] + $params);
    }

    public function start($flowName, array $params = [])
    {
        return $this->request([
            'Action' => 'StartExecution',
            'FlowName' => $flowName,
        ] + $params);
    }

    public function stop($executionName, $flowName, array $params = [])
    {
        return $this->request([
            'Action' => 'StopExecution',
            'ExecutionName' => $executionName,
            'FlowName' => $flowName,
        ] + $params);
    }

    public function history($executionName, $flowName, array $params = [])
    {
        return $this->request([
            'Action' => 'GetExecutionHistory',
            'ExecutionName' => $executionName,
            'FlowName' => $flowName,
        ] + $params);
    }
}
