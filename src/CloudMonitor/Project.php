<?php



namespace HttpClient\Aliyun\CloudMonitor;

class Project extends Definition
{
    public function meta(array $params = [])
    {
        return $this->request([
            'Action' => 'DescribeProjectMeta',
        ] + $params);
    }
}
