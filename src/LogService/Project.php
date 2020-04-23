<?php



namespace HttpClient\Aliyun\LogService;

class Project extends Definition
{
    public function create($projectName)
    {
        return $this->request('POST', '/', [
            'json' => ['projectName' => $projectName],
        ]);
    }

    public function list()
    {
        return $this->request('GET', '/');
    }
}
