<?php



namespace HttpClient\Aliyun\RelationalDatabaseService;

class Database extends Encapsulation
{
    public function list($instanceId, array $params = [])
    {
        return $this->request([
            'Action' => 'DescribeDatabases',
            'DBInstanceId' => $instanceId,
        ] + $params);
    }

    public function create($instanceId, $name, $charset, $description = null)
    {
        return $this->request([
            'Action' => 'CreateDatabase',
            'DBInstanceId' => $instanceId,
            'DBName' => $name,
            'CharacterSetName' => $charset,
            'DBDescription' => $description,
        ]);
    }
}
