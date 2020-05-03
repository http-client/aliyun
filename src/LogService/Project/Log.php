<?php



namespace HttpClient\Aliyun\LogService\Project;
use HttpClient\Aliyun\LogService\Definition;
class Log extends Definition
{
    public function get($logstoreName, $from, $to, array $params = [])
    {
        $query = array_merge([
            'type' => 'log',
            'from' => $from,
            'to' => $to,
        ], $params);

        return $this->request('GET', "/logstores/{$logstoreName}", compact('query'));
    }
}
