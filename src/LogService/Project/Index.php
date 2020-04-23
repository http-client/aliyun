<?php



namespace HttpClient\Aliyun\LogService\Project;

use HttpClient\Aliyun\LogService\Definition;

class Index extends Definition
{
    public function get($logstoreName)
    {
        return $this->request('GET', "/logstores/{$logstoreName}/index");
    }

    public function create($logstoreName, array $params)
    {
        return $this->request('POST', "/logstores/{$logstoreName}/index", ['json' => $params]);
    }
}
