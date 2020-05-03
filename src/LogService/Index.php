<?php

namespace HttpClient\Aliyun\LogService;

class Index extends Definition
{
    public function get($project, $logstoreName)
    {
        return $this->request('GET', $res = "/logstores/{$logstoreName}/index", [], $this->app->getLogProjectBaseUri($project).$res);
    }

    public function create($project, $logstoreName, array $params)
    {
        return $this->request('POST', $res="/logstores/{$logstoreName}/index", ['json' => $params], $this->app->getLogProjectBaseUri($project).$res);
    }
}
