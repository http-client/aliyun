<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Aliyun\ObjectStorageService\Encapsulation;

class BucketObject extends Encapsulation
{
    public function head($bucket, $objectName)
    {
        return $this->requestBucketEndpoint($bucket, 'HEAD', '/'.$objectName);
    }

    public function get($bucket, $name)
    {
        return $this->requestBucketEndpoint($bucket, 'GET', '/'.$name);
        // return $this->request('GET', $this->getBucketBaseUri($bucket).'/'.$name);
    }

    public function put($bucket, $objectName, $body)
    {
        return $this->request('PUT', $this->getBucketBaseUri($bucket).'/'.$objectName, ['body' => $body]);
    }
}
