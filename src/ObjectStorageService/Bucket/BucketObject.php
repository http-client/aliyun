<?php



namespace HttpClient\Aliyun\ObjectStorageService\Bucket;

use HttpClient\Aliyun\ObjectStorageService\Encapsulation;

class BucketObject extends Encapsulation
{
    public function head($objectName)
    {
        return $this->request('HEAD', '/'.$objectName);
    }

    public function get($name)
    {
        return $this->request('GET', '/'.$name);
    }

    public function put($objectName, $body)
    {
        return $this->request('PUT', '/'.$objectName, ['body' => $body]);
    }
}
