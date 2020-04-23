<?php



namespace HttpClient\Aliyun\LogService\Project;
use HttpClient\Aliyun\LogService\Definition;
class Logstore extends Definition
{
    public function get($name)
    {
        return $this->request('GET', "/logstores/{$name}");
    }

    public function create($name, array $params = [])
    {
        return $this->request('POST', '/logstores', [
            'json' => array_merge([
                'logstoreName' => $name,
            ], $params),
        ]);
    }

    public function list()
    {
        $headers = $this->authenticateWithHeaders('GET', $resource = '/logstores');

        return $this->request('GET', $resource, ['headers' => $headers]);
    }
}
