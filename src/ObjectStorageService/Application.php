<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Aliyun\Signature\AuthorizationSignature;
use HttpClient\Application as BaseApplication;
use Psr\Http\Message\RequestInterface;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'service' => Service::class,
        'bucket' => Bucket::class,
        'object' => BucketObject::class,
    ];

    /**
     * Get the base uri for the given bucket.
     *
     * @param  string $bucket
     *
     * @return string
     */
    public function getBucketBaseUri($bucket)
    {
        $parsed = parse_url($this->client->getBaseUri());

        return sprintf('%s://%s', $parsed['scheme'], $bucket.'.'.$parsed['host']);
    }

    public function signedRequest(RequestInterface $request, $expires = '30 minutes')
    {
// dd($request->getUri()->getPath());
        $resource = '';

        $signature = AuthorizationSignature::sign(
            $request->getMethod(), '',
            $request->getHeaderLine('Content-Type'),
            $expires,
            [],
            $resource, $this->config['access_key_secret']
        );

        $query = http_build_query([
            'OSSAccessKeyId' => $this->config['access_key_id'],
            'Expires' => $expires,
            'Signature' => $signature,
            'security-token' => $this->config['security_token'] ?? null,
        ]);
        // dd($this->client->getBaseUri());
// return $request->getUri()->__toString();
        return sprintf('%s/%s?%s', $this->client->getBaseUri(), '', $query);
    }

    // public function bucketxxx($name)
    // {
        // $parsed = parse_url($this->client->getBaseUri());

        // $baseUri = sprintf('%s://%s', $parsed['scheme'], $name.'.'.$parsed['host']);

        // return new Bucket\Application(array_merge($this->config->all(), [
        //     'bucket' => $name,
        //     'http' => [
        //         'base_uri' => $baseUri,
        //     ],
        // ]));
    // }
}
