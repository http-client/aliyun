<?php



namespace HttpClient\Aliyun\NetworkAttachedStorage;

class Filesystem extends Encapsulation
{
    public function list(array $params = [])
    {
        return $this->request(array_merge([
            'Action' => 'DescribeFileSystems',
        ], $params));
    }

    public function create(array $params)
    {
        return $this->request([
            'Action' => 'CreateFileSystem',
        ] + $params);
    }

    public function delete($fileSystemId)
    {
        return $this->request([
            'Action' => 'DeleteFileSystem',
            'FileSystemId' => $fileSystemId,
        ]);
    }

    public function update($fileSystemId, $description = null)
    {
        return $this->request([
            'Action' => 'ModifyFileSystem',
            'FileSystemId' => $fileSystemId,
            'Description' => $description,
        ]);
    }
}
