<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Application as BaseApplication;

class BucketApplication extends BaseApplication
{
    use AuthorizesUrls;

    /**
     * The client instances.
     *
     * @var array
     */
    protected $clients = [
        'client' => Client::class,
        'object' => BucketObject::class,
    ];

    public function info()
    {
        return $this->client->request('GET', '/?bucketInfo');
    }

    public function create($acl = null)
    {
        return $this->client->request('PUT', '/', [
            'headers' => array_filter([
                'x-oss-acl' => $acl,
            ]),
        ]);
    }

    public function delete()
    {
        return $this->client->request('DELETE', '/');
    }
}
