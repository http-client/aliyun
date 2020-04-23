<?php



namespace HttpClient\Aliyun\CloudMonitor;

class Metric extends Definition
{
    public function meta($namespace, array $params = [])
    {
        return $this->request([
            'Action' => 'DescribeMetricMetaList',
            'Namespace' => $namespace,
        ] + $params);
    }

    public function list($namespace, $metricName, array $params = [])
    {
        return $this->request([
            'Action' => 'DescribeMetricList',
            'MetricName' => $metricName,
            'Namespace' => $namespace,
        ] + $params);
    }
}
