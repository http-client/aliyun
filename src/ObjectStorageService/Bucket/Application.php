<?php



namespace HttpClient\Aliyun\ObjectStorageService\Bucket;

use HttpClient\Aliyun\ObjectStorageService\AuthorizesUrls;
use HttpClient\Aliyun\ObjectStorageService\Definition;
use HttpClient\Aliyun\ObjectStorageService\Encapsulation;
use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    use AuthorizesUrls;

    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'encapsulate_request' => Encapsulation::class,
        'object' => BucketObject::class,
    ];

    public function info()
    {
        return $this->encapsulate_request->request('GET', '/?bucketInfo');
    }

    public function create($acl = null)
    {
        return $this->encapsulate_request->request('PUT', '/', [
            'headers' => array_filter([
                'x-oss-acl' => $acl,
            ]),
        ]);
    }

    public function delete()
    {
        return $this->encapsulate_request->request('DELETE', '/');
    }
}
