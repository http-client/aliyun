<?php



namespace HttpClient\Aliyun\ObjectStorageService;

class Service extends Encapsulation
{
    public function list()
    {
        return $this->request('GET', '/');
    }
}
