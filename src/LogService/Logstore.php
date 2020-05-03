<?php

namespace HttpClient\Aliyun\LogService;

class Logstore extends Definition
{
    public function get($project, $logstore)
    {
        // dd($this->app->getLogProjectBaseUri($project));
        return $this->request('GET', $res = '/logstores/'.$logstore, [], $this->app->getLogProjectBaseUri($project).$res);
    }

    public function create($project, $logstore, array $params = [])
    {
        return $this->request('POST', '/logstores', [
            'json' => array_merge([
                'logstoreName' => $logstore,
            ], $params),
        ], $this->app->getLogProjectBaseUri($project).'/logstores');
    }

    public function list()
    {
        $headers = $this->authenticateWithHeaders('GET', $resource = '/logstores');

        return $this->request('GET', $resource, ['headers' => $headers]);
    }
}
